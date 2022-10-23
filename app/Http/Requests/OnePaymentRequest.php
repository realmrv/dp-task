<?php

namespace App\Http\Requests;

use App\Services\OneRequestSignCheckerService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OnePaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'merchant_id' => 'required|int',
            'payment_id' => 'required|int',
            'status' => 'required|string',
            'amount' => 'required|int',
            'amount_paid' => 'required|int',
            'timestamp' => 'required|int',
            'sign' => 'required|string',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if (! $this->isJson()) {
            throw new BadRequestHttpException('Wrong content type');
        }
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    protected function passedValidation(): void
    {
        /** @var OneRequestSignCheckerService $requestSignService */
        $requestSignService = App::make(OneRequestSignCheckerService::class);
        if (! $requestSignService->check($this)) {
            $this->failedAuthorization();
        }
    }
}
