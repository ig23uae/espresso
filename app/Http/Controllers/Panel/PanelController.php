<?php

namespace App\Http\Controllers\Panel;

use App\Enums\OrderStatus;
use App\Events\OrderPaid;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Controller;
use App\Models\Drink;
use App\Models\DrinkSizePivot;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDrinkDetail;
use App\Models\OrderFoodDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coffee = Drink::all();
        return view('panel.index', ['coffee' => $coffee]);
    }


    public function getDrinksByType($typeName, $typeId): \Illuminate\Http\JsonResponse
    {
        if ($typeName == 'food'){
            $product = Food::where('type_id', $typeId)->get();
        }elseif($typeName == 'drink'){
            $product = Drink::where('type_id', $typeId)->get();
        }else{
            $product = [];
        }
        return response()->json($product);
    }

    public function getSizes($drinkId)
    {
        $drink = Drink::find($drinkId);
        $sizes = $drink->sizes()->get();
        return response()->json($sizes);
    }

    public function findClient(Request $request)
    {
        $email = $request->email;
        $client = User::where('email', $email)->first();

        if ($client) {
            return response()->json(['found' => true, 'client_id' => $client->id, 'client_name' => $client->name]);
        } else {
            return response()->json(['found' => false]);
        }
    }

    public function submitOrder(Request $request)
    {
        $drinks = $request->input('drinks', []);
        $foods = $request->input('foods', []);
        $user_id = $request->input('client_id');
        //$cashier = Auth::user();

        if (!isset($drinks) && !isset($foods)){
            return redirect()->back();
        }

        $order = Order::firstOrCreate(
            ['customer_id' => $user_id, 'status' => OrderStatus::Create],
            ['total_price' => 0]
        );
        $sum = 0;
        foreach ($drinks as $drink){
            $drink_pivot = DrinkSizePivot::where('drink_id', $drink['drink_id'])
                ->where('size_id', $drink['size_id'])
                ->first();
            if ($drink_pivot){
                $sum += $drink_pivot->price;
                OrderDrinkDetail::create([
                    'order_id' => $order->id,
                    'drink_pivot_id' => $drink_pivot->id,
                ]);
            }
        }
        foreach ($foods as $food){
            $sum += $food['price'];
            OrderFoodDetail::create([
                'order_id' => $order->id,
                'food_id' => $food['food_id'],
            ]);
        }

        // Обновляем общую стоимость заказа
        $order->status = OrderStatus::Processing;
        $order->total_price = $sum;
        $order->save();

        //Отправляем заказ бариста
        event(new OrderPaid($order->id));

        return redirect()
            ->route('panel_index')
            ->with('success', 'Заказ успешно создан. Номер вашего заказа: ' . $order->order_number);
    }
}
