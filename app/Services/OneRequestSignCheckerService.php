<?php

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

final class OneRequestSignCheckerService extends AbstractRequestSignCheckerService
{
    protected function getRequestMerchantId(FormRequest $request): string
    {
        return $request->validated('merchant_id');
    }

    protected function getRequestSign(FormRequest $request): string
    {
        return $request->validated('sign');
    }

    protected function getSeparator(): string
    {
        return ':';
    }

    protected function getExcludedValues(): array
    {
        return ['sign'];
    }

    protected function getHashingAlgorithm(): string
    {
        return 'sha256';
    }
}
