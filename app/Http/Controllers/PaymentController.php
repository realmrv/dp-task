<?php

namespace App\Http\Controllers;

use App\Enums\GatewayCodeEnum;
use App\Http\Dto\PaymentNotificationDto;
use App\Http\Requests\OnePaymentRequest;
use App\Http\Requests\TwoPaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(private readonly PaymentService $paymentService)
    {
    }

    public function one(OnePaymentRequest $request)
    {
        $params = $request->validated();
        $this->paymentService->store(
            new PaymentNotificationDto(
                $params['merchant_id'],
                $params['payment_id'],
                $params['status'],
                $params['amount'],
                $params['amount_paid'],
            ),
            GatewayCodeEnum::One
        );
    }

    public function two(TwoPaymentRequest $request)
    {
        $params = $request->validated();
        $this->paymentService->store(
            new PaymentNotificationDto(
                $params['project'],
                $params['invoice'],
                $params['status'],
                $params['amount'],
                $params['amount_paid'],
            ),
            GatewayCodeEnum::Two
        );
    }
}
