<?php

namespace App\Http\Dto;

class PaymentNotificationDto
{
    public function __construct(
        public readonly string $merchantId,
        public readonly string $paymentId,
        public readonly string $status,
        public readonly int $amount,
        public readonly int $amountPaid
    ) {
    }
}
