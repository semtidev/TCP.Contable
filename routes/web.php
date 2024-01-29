<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

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

Route::get('/', [AppController::class, 'index'])->name('index');
/*Route::get('/getmacshellexec',function()
    {
        $shellexec = substr(shell_exec('getmac'), 238,17); //shell_exec('getmac'); 
        //dd($shellexec);
        //dd(filter_var($shellexec, FILTER_VALIDATE_MAC));
        dd(preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $shellexec));
    }
);
Route::get('/getmacexec',function()
    {
        $shellexec = exec('getmac'); 
        dd($shellexec);
    }
);*/