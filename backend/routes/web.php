<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;

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

Route::get(
    '/api/phpinfo',
    function () {
        phpinfo();
    }
);
// Route::get( '/api/users', function () {
//     return User::all();
// });

Route::resource('/api/groups', App\Http\Controllers\GroupController::class);
