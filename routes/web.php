<?php

use App\Http\Controllers\Web\Admin\ThemeContoller;
use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\AgentController;use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Admin\AdminManage\AdminManageController;
use App\Http\Controllers\Web\Admin\ProfileController as AdminProfile;
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
Route::prefix('admin/')->middleware(['auth','role:admin'])->group(function(){
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');

    // profile
    Route::get('profile',[AdminProfile::class,'index'])->name('admin.profile');
    Route::post('profile/update',[AdminProfile::class,'update'])->name('admin.profile.update');
    Route::get('password/update',[AdminProfile::class,'viewChangePassword'])->name('admin.password.change');
    Route::post('password/update',[AdminProfile::class,'changePassword'])->name('admin.password.update');
    // change theme
    Route::get('theme/light',[ThemeContoller::class,'light'])->name('admin.theme.light');
    Route::get('theme/dark',[ThemeContoller::class,'dark'])->name('admin.theme.dark');

    // admin management
    Route::get('admin_manage/',[AdminManageController::class,'index'])->name('admin.admin_manage.show');
    Route::get('admin_manage/{id}',[AdminManageController::class,'show'])->name('admin.admin_manage');

});
//
Route::prefix('admin/')->middleware('guest')->group(function(){
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');

});
// Route::middleware(['auth','role:teacher'])->group(function(){

//     Route::get('/teacher/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
// });

