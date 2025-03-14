<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RelawanController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/events/{event}', [EventController::class, 'publicShow'])->name('event.show');
Route::get('/events/register/{event}', [EventController::class, 'register'])
    ->name('event.register')
    ->middleware('member.session.key');

Route::prefix('dashboard')->group(function() {
    // events
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.events.index');
    Route::get('/events', [EventController::class, 'adminIndex'])->name('dashboard.events.index')->middleware('auth');
    Route::get('/events/create', [EventController::class, 'create'])->name('dashboard.events.create')->middleware('auth');
    Route::post('/events', [EventController::class, 'store'])->name('dashboard.events.store')->middleware('auth');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('dashboard.events.show')->middleware('auth');
    Route::get('/events/{event}/attendance', [EventController::class, 'attendance'])->name('dashboard.events.attendance')->middleware('auth');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('dashboard.events.edit')->middleware('auth');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('dashboard.events.update')->middleware('auth');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('dashboard.events.destroy')->middleware('auth');

    // members
    Route::post('/members-attendances', [MemberController::class, 'storeAttendance'])->name('dashboard.members.storeAttendance')->middleware('auth');
    Route::get('/members', [MemberController::class, 'adminIndex'])->name('dashboard.members.index')->middleware('auth');
    Route::get('/members/{member}', [MemberController::class, 'show'])->name('dashboard.members.show')->middleware('auth');
    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('dashboard.members.edit')->middleware('auth');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('dashboard.members.update')->middleware('auth');

    // relawans
    Route::post('/relawans-attendances', [RelawanController::class, 'storeAttendance'])->name('dashboard.relawans.storeAttendance')->middleware('auth');
    Route::get('/relawans', [RelawanController::class, 'adminIndex'])->name('dashboard.relawans.index')->middleware('auth');
    Route::get('/relawans/{relawan}', [RelawanController::class, 'show'])->name('dashboard.relawans.show')->middleware('auth');
    Route::get('/relawans/{relawan}/edit', [RelawanController::class, 'edit'])->name('dashboard.relawans.edit')->middleware('auth');
    Route::put('/relawans/{relawan}', [RelawanController::class, 'update'])->name('dashboard.relawans.update')->middleware('auth');
});

Route::prefix('daftar')->group(function() {
    Route::get('/', [MemberController::class, 'index'])->name('public.members.index');
    Route::get('/members/register', [MemberController::class, 'register'])->name('public.members.register');
    Route::post('/members', [MemberController::class, 'store'])->name('public.members.store');
    Route::get('/members/register_success', [MemberController::class, 'registerSuccess'])->name('public.members.register_success');

    Route::get('/relawans/register', [RelawanController::class, 'register'])->name('public.relawans.register');
    Route::post('/relawans', [RelawanController::class, 'store'])->name('public.relawans.store');
    Route::get('/relawans/register_success', [RelawanController::class, 'registerSuccess'])->name('public.relawans.register_success');
});

Route::get('/login-msp', [MemberController::class, 'loginMsp'])->name('public.members.login_msp');

Route::prefix('login-member')->group(function() {
    Route::get('/login', [MemberController::class, 'login'])->name('public.members.login');
    Route::post('/login', [MemberController::class, 'storeLogin'])->name('public.members.storeLogin');
    Route::get('/login_success', [MemberController::class, 'loginSuccess'])->name('public.members.login_success')->middleware('member.session.key');
    Route::get('/logout', [MemberController::class, 'logout'])->name('public.members.logout')->middleware('member.session.key');
});

Route::prefix('login-relawan')->group(function() {
    Route::get('/login', [RelawanController::class, 'login'])->name('public.relawans.login');
    Route::post('/login', [RelawanController::class, 'storeLogin'])->name('public.relawans.storeLogin');
    Route::get('/login_success', [RelawanController::class, 'loginSuccess'])->name('public.relawans.login_success')->middleware('member.session.key');
    Route::get('/logout', [RelawanController::class, 'logout'])->name('public.relawans.logout')->middleware('member.session.key');
});
