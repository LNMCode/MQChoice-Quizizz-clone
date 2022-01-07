<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\AdminController;

use \App\Http\Controllers\Users\LoginController;
use \App\Http\Controllers\Users\JoinRoomController;
use \App\Http\Controllers\Users\RoomQuesController;
use \App\Http\Controllers\Users\EnterCodeController;
use \App\Http\Controllers\Users\WaitRoomFisnishController;
use \App\Http\Controllers\Users\SummaryController;

use \App\Http\Controllers\Host\HostRoomController;
use \App\Http\Controllers\Host\ManageRoomController;
use \App\Http\Controllers\Host\HostFlowRoomController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/signout', [HomeController::class, 'signout']);

Route::get('/users/login', [LoginController::class, 'index']);
Route::get('/users/logincreatenew', [LoginController::class, 'logincreatenew']);
Route::post('/users/login', [LoginController::class, 'login']);

Route::get('/admin', [AdminController::class, 'index']);

Route::post('/users/joinroom', [JoinRoomController::class, 'index']);

Route::get('/users/joinroom/start', [RoomQuesController::class, 'index']);

Route::get('/entercode', [EnterCodeController::class, 'index']);

Route::get('/manageroom/{idroom}', [ManageRoomController::class, 'index']);
Route::get('/manageroomdownloadform', [ManageRoomController::class, 'downloadform']);
Route::post('/addquestionbycsv', [ManageRoomController::class, 'insertform']);

Route::get('/host/{idroom}', [HostRoomController::class, 'index']);

Route::get('/hostflowroom/flowroom', [HostFlowRoomController::class, 'index']);

Route::get('/summary/{idroom}/{iduser}', [SummaryController::class, 'index']);

Route::get('/waitroomfinish/{idroom}/{iduser}', [WaitRoomFisnishController::class, 'index']);

Route::post('/admin/public', [AdminController::class, 'public']);