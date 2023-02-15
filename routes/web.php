<?php

use App\Http\Controllers\Angler\FishController as AnglerFishController;
use App\Http\Controllers\Customer\FishController as CustomerFishController;
use App\Http\Controllers\Angler\DestinationController as AnglerDestinationController;
use App\Http\Controllers\Customer\DestinationController as CustomerDestinationController;
use App\Http\Controllers\Angler\CatcherController as AnglerCatcherController;
use App\Http\Controllers\Customer\CatcherController as CustomerCatcherController;
use App\Models\destination;
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
//brings customer to welcome page
Route::get('/', function ()
{
    return view('welcome');
});

//brings customer to the deshboard page after they pass verification
Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home/destinations', [App\Http\Controllers\HomeController::class, 'destinationIndex'])->name('home.destination.index');
Route::get('/home/catchers', [App\Http\Controllers\HomeController::class, 'catcherIndex'])->name('home.catcher.index');

//moves the customer to with help of the train controller through the website if they are and angler
Route::resource('/angler/fishs', AnglerFishController::class)->middleware(['auth'])->names('angler.fishs');

//moves the customer to with help of the train controller through the website if they are and customer and restricts them the the index and show pages
Route::resource('/customer/fishs', CustomerFishController::class)->middleware(['auth'])->names('customer.fishs')->only(['index', 'show']);

//moves the customer to with help of the destination controller through the website if they are and angler
Route::resource('/angler/destinations', AnglerDestinationController::class)->middleware(['auth'])->names('angler.destinations');

//moves the customer to with help of the destination controller through the website if they are and customer and restricts them the the index and show pages
Route::resource('/customer/destinations', CustomerDestinationController::class)->middleware(['auth'])->names('customer.destinations')->only(['index', 'show']);

//moves the customer to with help of the catcher controller through the website if they are and angler
Route::resource('/angler/catchers', AnglerCatcherController::class)->middleware(['auth'])->names('angler.catchers');

//moves the customer to with help of the catcher controller through the website if they are and customer and restricts them the the index and show pages
Route::resource('/customer/catchers', CustomerCatcherController::class)->middleware(['auth'])->names('customer.catchers')->only(['index', 'show']);
