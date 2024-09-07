<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, "showCorrectHomepage"]);

Route::get('/about', [UserController::class, "aboutPage"]);

Route::get('/dashboard', [UserController::class, "Dashboard"]);

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/goHome', [UserController::class, 'goHome']);

Route::post('/viewabout', [UserController::class, 'goAbout']);

Route::get('/tasks', [TaskController::class, 'tasks']);

Route::post('/addTask', [TaskController::class, 'addTask'])->name('addTask');

Route::post('/completeTask', [TaskController::class, 'completeTask'])->name('completeTask');

Route::get('/completedTask', [TaskController::class, 'completedTask'])->name('completedTask');

//Org route

Route::get('/orgTasks', [TaskController::class, 'orgTasks'])->name('orgTasks');
Route::post('/addtableOrg', [TaskController::class, 'addTableOrg']);
Route::post('/editTableTask', [TaskController::class, 'editTableTask']);
Route::post('/completeTaskOrg', [TaskController::class, 'completeTaskOrg'])->name('completeTaskOrg');

//Profile related route

Route::get('/viewAbout', [UserController::class, 'aboutPage']);

Route::get('/viewprofile', [UserController::class, 'viewProfile']);

Route::get('/profile', [UserController::class, 'goProfile']);

Route::get('/editprofile', [UserController::class, 'editProfile']);

Route::post('/saveProfile', [UserController::class, 'saveProfile']);

Route::get('/editpass', [UserController::class, 'editPass']);

Route::post('/savePass', [UserController::class, 'savePass']);