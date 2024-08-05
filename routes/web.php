<?php

use App\Http\Controllers\Web\Admin\ThemeContoller;
use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Localization\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Admin\AdminManage\AdminManageController;
use App\Http\Controllers\Web\Admin\AdminManage\StudentManageController;
use App\Http\Controllers\Web\Admin\AdminManage\TeacherManageController;
use App\Http\Controllers\Web\Admin\SchoolManage\GradeLevelController;
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

    // main
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'destroy'])->name('logout');

    // profile details and change it
    Route::get('profile',[AdminProfile::class,'index'])->name('profile');
    Route::post('profile/update',[AdminProfile::class,'update'])->name('profile.update');
    // change password
    Route::get('password/update',[AdminProfile::class,'viewChangePassword'])->name('password.change');
    Route::post('password/update',[AdminProfile::class,'changePassword'])->name('password.update');
    // change theme light or dark
    Route::get('theme/light',[ThemeContoller::class,'light'])->name('theme.light');
    Route::get('theme/dark',[ThemeContoller::class,'dark'])->name('theme.dark');

    //management
    //User management
    Route::resource('admin_manage',AdminManageController::class); // resource for admin
    Route::resource('student_manage',StudentManageController::class); // resource for student
    Route::resource('teacher_manage',TeacherManageController::class); // resource for teacher
    Route::resource('role',RoleController::class); // resource for role
    //school management
    Route::resource('grade_level',GradeLevelController::class);
});
//
Route::prefix('admin/')->middleware('guest')->group(function(){
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');

});
// TODO later add teacher and student pages
// Route::middleware(['auth','rol:teacher'])->group(function(){

//     Route::get('/teacher/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
// });
// change language (ar-en)
Route::get('locale/{locale}',[LocaleController::class,'setLocale'])->name('setLocale');

