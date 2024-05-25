<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatusEnum;
use App\Events\OrderPaid;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Transactions;
use App\Service\PaymentService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use YooKassa\Common\Exceptions\ApiConnectionException;
use YooKassa\Common\Exceptions\ApiException;
use YooKassa\Common\Exceptions\AuthorizeException;
use YooKassa\Common\Exceptions\BadApiRequestException;
use YooKassa\Common\Exceptions\ExtensionNotFoundException;
use YooKassa\Common\Exceptions\ForbiddenException;
use YooKassa\Common\Exceptions\InternalServerError;
use YooKassa\Common\Exceptions\NotFoundException;
use YooKassa\Common\Exceptions\ResponseProcessingException;
use YooKassa\Common\Exceptions\TooManyRequestsException;
use YooKassa\Common\Exceptions\UnauthorizedException;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;

class PaymentController extends Controller
{
    /**
     * @param $rate_id
     * @param $user_id
     * @param PaymentService $service
     * @param null $event_id
     * @return RedirectResponse|void
     * @throws ApiConnectionException
     * @throws ApiException
     * @throws AuthorizeException
     * @throws BadApiRequestException
     * @throws ExtensionNotFoundException
     * @throws ForbiddenException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws ResponseProcessingException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     */
    public function create($order_id, PaymentService $service)
    {
        //Проверяем что пользователь и тариф существуют
        $order = Order::findOrFail($order_id);

        $transaction = Transaction::create([
            'price' => $order->total_price,
            'order_id' => $order->id
        ]);

        $description = "Оплата заказа: " . $order->order_number;

        if ($transaction) {
            $link = $service->createPayment($order->total_price, $description, [
                'transaction_id' => $transaction->id,
                'order_id' => $order->id
            ]);
            //Можно проверять ссылка ли $link
            return redirect()->away($link);
        }
    }

    /**
     * @param PaymentService $service
     * @return void
     * @throws ApiException
     * @throws BadApiRequestException
     * @throws ExtensionNotFoundException
     * @throws ForbiddenException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws ResponseProcessingException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     * @throws GuzzleException
     */
    public function callback(PaymentService $service): void
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
        $payment = $notification->getObject();
        if (isset($payment->status) && $payment->status === 'waiting_for_capture') {
            $service->getClient()->capturePayment([
                'amount' => $payment->amount,
            ], $payment->id, uniqid('', true));
        }

        if (isset($payment->status) && $payment->status === 'succeeded') {
            if ((bool)$payment->paid === true) {
                $metadata = (object)$payment->metadata;
                if (isset($metadata->transaction_id)) {
                    //Подтверждаем оплату
                    $transactionId = (int)$metadata->transaction_id;
                    $transaction = Transaction::findOrFail($transactionId);
                    $transaction->status = PaymentStatusEnum::SUCCEEDED;
                    $transaction->save();
                    //Меняем статус заказа
                    $order = Order::with(['drinkDetails.drinkSizePivot.drink', 'drinkDetails.drinkSizePivot.size'])
                    ->findOrFail($metadata->order_id);
                    $order->status = OrderStatus::Processing;
                    $order->save();
                    //Очищаем сесиию
                    Session::forget('cart');
                    Session::forget('total_items');
                    // Триггерим событие
                    event(new OrderPaid($order));
                }
            }
        }
    }
}
