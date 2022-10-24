<?php

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

final class TwoRequestSignCheckerService extends AbstractRequestSignCheckerService
{
    protected function getRequestMerchantId(FormRequest $request): string
    {
        return $request->validated('project');
    }

    protected function getRequestSign(FormRequest $request): string
    {
        return $request->header('Authorization');
    }

    protected function getSeparator(): string
    {
        return '.';
    }

    protected function getExcludedValues(): array
    {
        return [];
    }

    protected function getHashingAlgorithm(): string
    {
        return 'md5';
    }
}
