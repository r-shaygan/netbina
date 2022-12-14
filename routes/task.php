<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::resource('/tasks',TaskController::class);

Route::get('/tasks/accept/{task}',[TaskController::class,'accept'])->name('tasks.accept');

Route::post('/tasks/assign/{task}',[TaskController::class,'assign'])->name('tasks.assign');

Route::get('/task/own',[TaskController::class,'ownTasks'])->name('tasks.own');
