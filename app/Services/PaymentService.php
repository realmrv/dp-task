<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;
use App\Exceptions\LimitExceededException;
use App\Http\Dto\PaymentNotificationDto;
use App\Models\Payment;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Throwable;

final class PaymentService implements IPaymentService
{
    public function __construct(
        private readonly GatewayService $gatewayService,
        private readonly MerchantService $merchantService
    ) {
    }

    /**
     * @throws LimitExceededException
     * @throws Throwable
     */
    public function store(PaymentNotificationDto $dto, GatewayCodeEnum $gatewayCodeEnum): void
    {
        DB::transaction(function () use ($gatewayCodeEnum, $dto) {
            if (
                $this->gatewayService->checkLimit(
                    $gatewayCodeEnum,
                    $this->getAmountForTodayByGateway($gatewayCodeEnum)
                ) === false
            ) {
                throw new LimitExceededException('The transactions amount limit is reached for today.');
            }

            Payment::whereRelation('merchant.gateway', 'code', $gatewayCodeEnum->value)
                ->updateOrCreate(
                    ['external_id' => $dto->paymentId],
                    [
                        'status' => $dto->status,
                        'amount' => $dto->amount,
                        'amount_paid' => $dto->amountPaid,
                        'merchant_id' => $this->merchantService->getMerchant($dto->merchantId, $gatewayCodeEnum)->id,
                    ]
                );
        });
    }

    private function getAmountForTodayByGateway(GatewayCodeEnum $gatewayCodeEnum): int
    {
        return Payment::whereRelation('merchant.gateway', 'code', $gatewayCodeEnum->value)
            ->whereDate('created_at', CarbonImmutable::today())
            ->sum('amount_paid');
    }
}
