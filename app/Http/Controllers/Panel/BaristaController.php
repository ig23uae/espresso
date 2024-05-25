<?php

namespace App\Http\Controllers\Panel;

use App\Enums\OrderStatus;
use App\Events\OrderStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaristaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('panel.barista');
    }

    public function getOrderDetails($orderId)
    {
        $order = Order::with(['drinkDetails.drinkSizePivot.drink', 'drinkDetails.drinkSizePivot.size', 'foods'])->find($orderId);
        if ($order) {
            return response()->json($order);
        } else {
            return response()->json(['error' => 'Заказ не найден'], 404);
        }
    }

    public function ready($orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false], 404);
        }
        $order->status = OrderStatus::Ready;
        $order->save();
        // Отправить уведомление через Pusher
        event(new OrderStatusChanged($order));
        return response()->json(['success' => true, 'status' => $order->status]);
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
