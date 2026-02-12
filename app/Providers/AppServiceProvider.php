<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Eloquent\CustomerRepository;

use App\Repositories\Contracts\ItemsRepositoryInterface;
use App\Repositories\Eloquent\ItemsRepository;

use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Repositories\Eloquent\SupplierRepository;

use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Repositories\Eloquent\AccountRepository;

use App\Repositories\Contracts\TypePaymentRepositoryInterface;
use App\Repositories\Eloquent\TypePaymentRepository;

use App\Repositories\Contracts\SectionRepositoryInterface;
use App\Repositories\Eloquent\SectionRepository;

use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Repositories\Eloquent\SaleRepository;

use App\Repositories\Contracts\SaleDetailRepositoryInterface;
use App\Repositories\Eloquent\SaleDetailRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            ItemsRepositoryInterface::class,
            ItemsRepository::class
        );

        $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );

        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepository::class
        );

        $this->app->bind(
            TypePaymentRepositoryInterface::class,
            TypePaymentRepository::class
        );

        $this->app->bind(
            SectionRepositoryInterface::class,
            SectionRepository::class
        );

        $this->app->bind(
            SaleRepositoryInterface::class,
            SaleRepository::class
        );

        $this->app->bind(
            SaleDetailRepositoryInterface::class,
            SaleDetailRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->group(base_path('routes/api_v1.php'));
    }
}
