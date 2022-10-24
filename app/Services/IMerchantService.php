<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;
use App\Models\Merchant;

interface IMerchantService
{
    public function getMerchant(int $externalId, GatewayCodeEnum $gatewayEnum): Merchant;
}
