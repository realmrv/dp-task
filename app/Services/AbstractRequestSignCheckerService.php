<?php

namespace App\Services;

use App\Enums\GatewayCodeEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class AbstractRequestSignCheckerService implements IRequestSignCheckerService
{
    protected readonly GatewayCodeEnum $gatewayCodeEnum;

    public function __construct(protected MerchantService $merchantService, string $gatewayCode)
    {
        $this->gatewayCodeEnum = GatewayCodeEnum::from($gatewayCode);
    }

    public function check(FormRequest $request): bool
    {
        return $this->generateSign($request) === $this->getRequestSign($request);
    }

    protected function generateSign(FormRequest $request): string
    {
        $sign = $this->implodeParams(
            $this->sortParams($request->validated()),
            $this->getSeparator(),
            $this->getExcludedValues()
        );

        try {
            $merchant = $this->merchantService->getMerchant(
                $this->getRequestMerchantId($request),
                $this->gatewayCodeEnum
            );
        } catch (ModelNotFoundException $e) {
            return false;
        }

        return $this->hash($this->attachKey($sign, $merchant->external_key), $this->getHashingAlgorithm());
    }

    protected function implodeParams(array $params, string $separator, array $exclude = []): string
    {
        return implode($separator, Arr::except($params, $exclude));
    }

    protected function sortParams(array $params, bool $asc = true): array
    {
        if ($asc) {
            ksort($params);
        } else {
            krsort($params);
        }

        return $params;
    }

    abstract protected function getSeparator(): string;

    /**
     * @return array<string>
     */
    abstract protected function getExcludedValues(): array;

    abstract protected function getRequestMerchantId(FormRequest $request): string;

    protected function hash(string $value, string $algo): string
    {
        return hash($algo, $value);
    }

    protected function attachKey(string $value, string $key): string
    {
        return $value.$key;
    }

    abstract protected function getHashingAlgorithm(): string;

    abstract protected function getRequestSign(FormRequest $request): string;
}
