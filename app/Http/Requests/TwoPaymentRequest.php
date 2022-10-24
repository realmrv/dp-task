<?php

namespace App\Http\Requests;

use App\Services\TwoRequestSignCheckerService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TwoPaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'project' => 'required|int',
            'invoice' => 'required|int',
            'status' => 'required|string',
            'amount' => 'required|int',
            'amount_paid' => 'required|int',
            'rand' => 'required|string',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->getContentType() !== 'form' || ! $this->hasHeader('Authorization')) {
            throw new BadRequestHttpException('Invalid content type and/or header set');
        }
    }

    /**
     * Handle a passed validation attempt.
     *
     * @throws AuthorizationException
     */
    protected function passedValidation(): void
    {
        /** @var TwoRequestSignCheckerService $requestSignService */
        $requestSignService = App::make(TwoRequestSignCheckerService::class);
        if (! $requestSignService->check($this)) {
            $this->failedAuthorization();
        }
    }
}
