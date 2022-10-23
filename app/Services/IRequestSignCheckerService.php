<?php

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

interface IRequestSignCheckerService
{
    public function check(FormRequest $request);
}
