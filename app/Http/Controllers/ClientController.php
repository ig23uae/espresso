<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use \Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        $cof = Drink::all();
        return view('panel.index', [
            'coffee' => $cof
        ]);
    }

    public function menu($type = null): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        if (isset($type)){
            $products = Drink::where('type', $type)->get();
        }else{
            $products = Drink::where('type', 'hot')->get();
        }
        dd(session());
        return view('client.menu', [
            'products' => $products
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function cart(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');
        $quantityChange = $request->input('quantity');
        #todo check to put different id for coffee and food
        #$cart[type] => [
        #   '1' => 3,
        #   '2' => 1,
        #]

        # а лучше наверное переделать на базу данных
        # у клиента будет формироваться неоплаченный заказ
        # у бариста будет все тоже самое только клиент будет не обязательным и тогда придется записывать баристу

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantityChange;
            if ($cart[$productId] <= 0) {
                unset($cart[$productId]);
            }
        } elseif ($quantityChange > 0) {
            $cart[$productId] = $quantityChange;
        }
        session()->put('cart', $cart);

        return response()->json(['success' => true, 'quantity' => $cart[$productId] ?? 0]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
