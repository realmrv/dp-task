<?php

namespace App\Providers;

use App\Enums\GatewayCodeEnum;
use App\Services\OneRequestSignCheckerService;
use App\Services\TwoRequestSignCheckerService;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->when([OneRequestSignCheckerService::class])
            ->needs('$gatewayCode')
            ->give(GatewayCodeEnum::One->value);
        $this->app->when([TwoRequestSignCheckerService::class])
            ->needs('$gatewayCode')
            ->give(GatewayCodeEnum::Two->value);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
