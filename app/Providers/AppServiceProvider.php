<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Repositories\Users\AdminRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void{
    //   $this->app->bind(\App\Repositories\Users\UserRepositoryInterface::class, AdminRepository::class);
        // $this->app->bind(\App\Repositories\Users\UserRepositoryInterface::class, function ($app) {
        //     $controller = $app->make(\Illuminate\Routing\Route::class)->getController();
        //     if ($controller instanceof \App\Http\Controllers\Web\Admin\AdminManage\AdminManageController) {
        //         return new AdminRepository();
        //     }
    //     });
    // $this->app->when(\App\Http\Controllers\Web\Admin\AdminManage\AdminManageController::class)
    //               ->needs(\App\Repositories\Users\UserRepositoryInterface::class)
    //               ->give(AdminRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
