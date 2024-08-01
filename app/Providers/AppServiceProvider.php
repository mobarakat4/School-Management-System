<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Repositories\Users\AdminRepository;
use \App\Repositories\Users\StudentRepository;
use \App\Repositories\Users\TeacherRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void{

    //   $this->app->bind(\App\Repositories\Users\UserRepositoryInterface::class, AdminRepository::class);
    $this->app->bind(\App\Repositories\Users\UserRepositoryInterface::class, function ($app) {
        $url =url()->current();

            if (strpos($url , 'admin_manage')) {
                return new AdminRepository();
            }elseif(strpos($url , 'student_manage')){
                return new StudentRepository();
            }elseif(strpos($url , 'teacher_manage')){
                return new TeacherRepository();
            }else{
                dd('error');
            }
        });
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
