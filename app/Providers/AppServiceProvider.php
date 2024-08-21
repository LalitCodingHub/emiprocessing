<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LoanDetailsRepositoryInterface;
use App\Repositories\LoanDetailsRepository;
use App\Services\LoanEMIServiceInterface;
use App\Services\LoanEMIService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoanDetailsRepositoryInterface::class, LoanDetailsRepository::class);
        $this->app->bind(LoanEMIServiceInterface::class, LoanEMIService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
