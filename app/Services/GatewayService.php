<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;
use App\Models\Gateway;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

final class GatewayService implements IGatewayService
{
    public function checkLimit(GatewayCodeEnum $gatewayCodeEnum, int $amount): bool
    {
        $limit = $this->getLimitByCode($gatewayCodeEnum);

        return $limit === null || $amount <= $limit;
    }

    private function getLimitByCode(GatewayCodeEnum $gatewayCodeEnum): int|null
    {
        return Cache::remember("gateway.$gatewayCodeEnum->value", 60 * 10, static function () use ($gatewayCodeEnum) {
            return Gateway::where(['code' => $gatewayCodeEnum->value])->firstOrFail()->amount_limit;
        });
    }

    /**
     * @throws Throwable
     */
    public function setLimitByCode(GatewayCodeEnum $gatewayCodeEnum, int $newLimit): void
    {
        DB::transaction(static function () use ($gatewayCodeEnum, $newLimit) {
            Gateway::where('code', $gatewayCodeEnum->value)->updateOrFail(['limit' => $newLimit]);
            Cache::forget("gateway.$gatewayCodeEnum->value");
        });
    }
}
