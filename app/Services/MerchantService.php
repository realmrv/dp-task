<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;
use App\Models\Merchant;
use Illuminate\Support\Facades\Cache;

final class MerchantService implements IMerchantService
{
    public function getMerchant(int $externalId, GatewayCodeEnum $gatewayEnum): Merchant
    {
        return Cache::remember(
            "merchant.$gatewayEnum->value.$externalId",
            60 * 5,
            static function () use ($externalId, $gatewayEnum) {
                return Merchant::where('external_id', $externalId)
                    ->whereRelation('gateway', 'code', $gatewayEnum->value)
                    ->firstOrFail();
            }
        );
    }
}
