<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;
use App\Http\Dto\PaymentNotificationDto;

interface IPaymentService
{
    public function store(PaymentNotificationDto $dto, GatewayCodeEnum $gatewayCodeEnum): void;
}
