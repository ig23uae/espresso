<?php

namespace App\Http\Controllers\Client;

use App\Enums\OrderStatus;
use App\Events\OrderPaid;
use App\Http\Controllers\Controller;
use App\Models\Drink;
use App\Models\DrinkSizePivot;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDrinkDetail;
use App\Models\OrderFoodDetail;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ClientController extends Controller
{
    /**
     * Главная страница
     * @return View|Application|Factory
     */
    public function index(): View|Application|Factory
    {
        $cof = Drink::all();
        return view('client.index', [
            'coffee' => $cof
        ]);
    }

    public function menu($type = null): View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        //Session::forget('cart');
        //session()->flush();
        //Отображение вкладок еды и напитков
        $drinks = Drink::with(['sizes', 'type']);
        $foods = Food::with('type');
        if ($type) {
            $drinks->whereHas('type', function ($query) use ($type) {
                $query->where('type_name', $type);
            });
            $foods->whereHas('type', function ($query) use ($type) {
                $query->where('type_name', $type);
            });
        }
        //Получаем последнюю корзину пользователя
        if (Auth::check()) {
            $user = Auth::user();

            // Получение последнего заказа пользователя
            $order = Order::with(['drinks.sizes', 'foods'])
                ->where('customer_id', $user->id)
                ->where('status', 'create')
                ->latest()
                ->first();
            if ($order) {
                $drinks_data = $order->drinks->mapWithKeys(function ($drink) {
                    $user = Auth::user();
                    $order = Order::with(['drinks.sizes', 'foods'])->where('customer_id', $user->id)->latest()->first();
                    $drinks_count = DB::table('orders')
                        ->join('order_drink_details', 'orders.id', '=', 'order_drink_details.order_id')
                        ->join('drink_size_pivots', 'order_drink_details.drink_pivot_id', '=', 'drink_size_pivots.id')
                        ->where('orders.customer_id', $user->id)
                        ->where('drink_size_pivots.size_id', $drink->sizes->first()->id)
                        ->where('drink_size_pivots.drink_id', $drink->id)
                        ->where('order_id', $order->id)
                        ->count();

                    return [$drink->id => [
                        'product_id' => $drink->id,
                        'quantity' => $drinks_count,
                        'size_id' => $drink->sizes->first()->id
                    ]];
                });
                $foods_data = $order->foods->mapWithKeys(function ($food) {
                    $user = Auth::user();
                    $order = Order::with(['drinks.sizes', 'foods'])->where('customer_id', $user->id)->latest()->first();
                    $foods_count = DB::table('orders')
                        ->join('order_food_details', 'orders.id', '=', 'order_food_details.order_id')
                        ->where('orders.customer_id', $user->id)
                        ->where('order_food_details.food_id', $food->id)
                        ->where('order_id', $order->id)
                        ->count();
                    return [$food->id => ['product_id' => $food->id,'quantity' => $foods_count]];
                });

                $totalItems = $drinks_data->sum('quantity') + $foods_data->sum('quantity');
                Session::put('cart', [
                    'drinks' => $drinks_data,
                    'foods' => $foods_data,
                ]);
                Session::put('total_items', $totalItems);
            }
        }

        return view('client.menu', [
            'drinks' => $drinks->get(),
            'foods' => $foods->get(),
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function cartUpdate(Request $request): JsonResponse
    {
        //Получаем пользователя и создаем заказ если был либо добавляем в предыдущий
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Необходима аутентификация.']);
        }

        $user = Auth::user();

        //Получаем продукт, тип продукта, размер, количество
        $productType = $request->input('product_type');
        $productId = $request->input('product_id');
        $productSize = $request->input('size_id');
        $quantityChange = $request->input('quantity');
        // Создаем или получаем последний активный заказ
        $order = Order::firstOrCreate(
            ['customer_id' => $user->id, 'status' => OrderStatus::Create],
            ['total_price' => 0]
        );

        // Получаем цену продукта
        $productPrice = $this->getProductPrice($productType, $productId, $productSize);
        if ($quantityChange > 0){
            // Добавляем продукт в заказ
            if ($productType === 'foods') {
                OrderFoodDetail::create([
                    'order_id' => $order->id,
                    'food_id' => $productId,
                ]);
            } elseif ($productType === 'drinks') {
                $drink_pivot = DrinkSizePivot::where('drink_id', $productId)
                    ->where('size_id', $productSize)
                    ->first();
                if ($drink_pivot){
                    OrderDrinkDetail::create([
                        'order_id' => $order->id,
                        'drink_pivot_id' => $drink_pivot->id,
                    ]);
                }
            }
        }else{
            // Убираем продукт из заказа
            if ($productType === 'foods') {
                OrderFoodDetail::where('order_id', $order->id)
                    ->where('food_id', $productId)
                    ->delete();
            } elseif ($productType === 'drinks') {
                $drink_pivot = DrinkSizePivot::where('drink_id', $productId)
                    ->where('size_id', $productSize)
                    ->first();
                if ($drink_pivot){
                    OrderDrinkDetail::where('order_id', $order->id)
                        ->where('drink_pivot_id', $drink_pivot->id)
                        ->delete();
                }
            }
        }

        // Обновляем общую стоимость заказа
        $order->total_price += $productPrice * $quantityChange;
        $order->save();

        $cart = session('cart', []);

        // Инициализация под массива для типа продукта, если он не существует
        if (!isset($cart[$productType])) {
            $cart[$productType] = [];
        }

        // Создаем уникальный ключ для каждой комбинации продукта и размера
        $uniqueKey = $productId . '-' . $productSize;

        // Обновление корзины с использованием map
        $cart[$productType] = collect($cart[$productType])->mapWithKeys(function ($item, $key) use ($uniqueKey, $productId, $productSize, $quantityChange) {
            if ($key === $uniqueKey) {
                // Уже существующий товар в корзине, обновляем количество
                $item['quantity'] += $quantityChange;
                if ($item['quantity'] <= 0) {
                    return []; // Удаление элемента, если количество равно нулю или меньше
                }
            }
            return [$key => $item];
        })->toArray();

        // Если товар новый и изменение количества положительное, добавляем его
        if (!isset($cart[$productType][$uniqueKey]) && $quantityChange > 0) {
            $cart[$productType][$uniqueKey] = [
                'product_id' => $productId,
                'size_id' => $productSize,
                'quantity' => $quantityChange
            ];
        }

        // Пересчёт общего количества товаров в корзине
        $totalItems = collect($cart)->reduce(function ($carry, $type) {
            return $carry + collect($type)->sum('quantity');
        }, 0);

        // Сохранение изменений в сессии
        session(['cart' => $cart, 'total_items' => $totalItems]);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total_items' => $totalItems
        ]);
    }

    public function getProductPrice($productType, $productId, $sizeId = null)
    {
        if ($productType === 'foods') {
            return Food::find($productId)->price;
        } elseif ($productType === 'drinks') {
            return Drink::find($productId)
                ->sizes()
                ->where('drink_sizes.id', $sizeId)
                ->first()
                ->pivot->price;
        }
        return 0;
    }


    //Отображение корзины
    public function cart($user_id)
    {
        //Получаем заказ
        $order = Order::with(['drinkDetails.drinkSizePivot.drink', 'drinkDetails.drinkSizePivot.size', 'foods'])
            ->where('customer_id', $user_id)
            ->where('status', OrderStatus::Create)
            ->latest()
            ->first();

        //Проверяем пользователя
        if (!Auth::check()) {
            if ($order->cusomer_id != auth()->user()->getAuthIdentifier()){
                return redirect()->route('client_index');
            }
        }

        return view('client.cart', ['order' => $order]);

    }

    //Отображение заказов
    public function orders()
    {
        if (!Auth::user()){
            return redirect()->route('client_index');
        }

        $user = Auth::user();
        $orders = Order::with(['drinkDetails.drinkSizePivot.drink', 'drinkDetails.drinkSizePivot.size', 'foods'])
            ->where('customer_id', $user->getAuthIdentifier())
            ->get();

        return view('client.orders', ['orders' => $orders]);
    }

    //Отображение одного заказа
    public function order($order_id)
    {
        if (!Auth::user()){
            return redirect()->route('client_index');
        }

        $order = Order::with(['drinkDetails.drinkSizePivot.drink', 'drinkDetails.drinkSizePivot.size', 'foods'])
            ->find($order_id);

        return view('client.order', ['order' => $order]);
    }


    //Кофейни рядом
    public function near()
    {
        return view('client.near');
    }
}
