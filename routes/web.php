<?php

use App\Http\Controllers\Web\Admin\ThemeContoller;
use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\AgentController;use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Admin\AdminManage\AdminManageController;
use App\Http\Controllers\Web\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\Web\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//admin
require __DIR__.'/auth.php';
Route::as('admin.')->prefix('admin/')->middleware(['auth','rol:admin'])->group(function(){
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'destroy'])->name('logout');

    // profile
    Route::get('profile',[AdminProfile::class,'index'])->name('profile');
    Route::post('profile/update',[AdminProfile::class,'update'])->name('profile.update');
    Route::get('password/update',[AdminProfile::class,'viewChangePassword'])->name('password.change');
    Route::post('password/update',[AdminProfile::class,'changePassword'])->name('password.update');
    // change theme
    Route::get('theme/light',[ThemeContoller::class,'light'])->name('theme.light');
    Route::get('theme/dark',[ThemeContoller::class,'dark'])->name('theme.dark');

    // admin management
    // Route::get('admin_manage/',[AdminManageController::class,'index'])->name('admin.admin_manage.show');
    // Route::get('admin_manage/{id}',[AdminManageController::class,'show'])->name('admin.admin_manage.show_one');
    // Route::get('admin_manage/add',[AdminManageController::class,'add'])->name('admin.admin_manage.add');
    Route::resource('admin_manage',AdminManageController::class);
    Route::resource('role',RoleController::class);


});
//
Route::prefix('admin/')->middleware('guest')->group(function(){
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');

});
// Route::middleware(['auth','rol:teacher'])->group(function(){

//     Route::get('/teacher/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
// });

