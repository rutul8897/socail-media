<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\SignUp;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\Profile;
use App\Livewire\Portal\Home;
use App\Livewire\Portal\Profile as PortalUserProfile;
use App\Livewire\Portal\Followers;
use App\Livewire\Admin\Users;

use App\Livewire\LaravelExamples\UserProfile;
use App\Livewire\LaravelExamples\UserManagement;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function() {
//     return redirect('/login');
// });

Route::middleware('user.auth')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/profile', PortalUserProfile::class)->name('user-profile');
    Route::get('/followers', Followers::class)->name('followers');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    // Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/users', Users::class)->name('users');
});
