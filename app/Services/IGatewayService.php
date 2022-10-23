<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;

interface IGatewayService
{
    public function checkLimit(GatewayCodeEnum $gatewayCodeEnum, int $amount): bool;

    public function setLimitByCode(GatewayCodeEnum $gatewayCodeEnum, int $newLimit): void;
}
