<?php
use App\Http\Controllers\Admin\FishController as AdminFishController;
use App\Http\Controllers\User\FishController as UserFishController;
use App\Http\Controllers\Admin\BasketController as AdminBasketController;
use App\Http\Controllers\User\BasketController as UserbasketController;
use App\Http\Controllers\Admin\FisheryController as AdminFisheryController;
use App\Http\Controllers\User\FisheryController as UserFisheryController;
use App\Models\basket;
use Database\Seeders\FishSeeder;
use Illuminate\Support\Facades\Route;

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
//brings user to welcome page
Route::get('/', function ()
{
    return view('welcome');
});

//brings user to the deshboard page after they pass verification
Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home/baskets', [App\Http\Controllers\HomeController::class, 'basketIndex'])->name('home.basket.index');
Route::get('/home/fisheries', [App\Http\Controllers\HomeController::class, 'fisheryIndex'])->name('home.fishery.index');

//moves the user to with help of the train controller through the website if they are and admin
Route::resource('/admin/fishs', AdminFishController::class)->middleware(['auth'])->names('admin.fishs');

//moves the user to with help of the train controller through the website if they are and user and restricts them the the index and show pages
Route::resource('/user/fishs', UserFishController::class)->middleware(['auth'])->names('user.fishs')->only(['index', 'show']);

//moves the user to with help of the basket controller through the website if they are and admin
Route::resource('/admin/baskets', AdminBasketController::class)->middleware(['auth'])->names('admin.baskets');

//moves the user to with help of the basket controller through the website if they are and user and restricts them the the index and show pages
Route::resource('/user/baskets', UserbasketController::class)->middleware(['auth'])->names('user.baskets')->only(['index', 'show']);

//moves the user to with help of the fishery controller through the website if they are and admin
Route::resource('/admin/fisheries', AdminFisheryController::class)->middleware(['auth'])->names('admin.fisheries');

//moves the user to with help of the fishery controller through the website if they are and user and restricts them the the index and show pages
Route::resource('/user/fisheries', UserFisheryController::class)->middleware(['auth'])->names('user.fisheries')->only(['index', 'show']);
