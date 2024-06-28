<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssignmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Admin
Route::prefix('admin')->controller(AdminController::class)->group(function (){
    Route::middleware('isAlreadyLogin')->group(function() {
        Route::get('/login', 'loginForm');
        Route::post('/login/action', 'loginAction');
    });
    Route::middleware('role@admin')->group(function (){
        Route::get('/', 'dashboard');
        Route::get('/logout', 'logout');

        Route::get('/student', 'studentIndex');
        Route::get('/student/pending', 'pendingStudent');
    });
});


// Student
Route::controller(StudentController::class)->group(function (){
    Route::middleware('isAlreadyLogin')->group(function (){
        Route::get('/login', 'loginForm');
        Route::post('/login/action', 'loginAction');
    });
    Route::middleware('role@student')->group(function (){
        Route::get('/dashboard', 'dashboard');
        Route::get('/logout', 'logout');
    });
});

Route::controller(ClassroomController::class)->group(function (){
    Route::middleware('role@admin')->group(function (){
        Route::get('/admin/classroom', 'index');
        Route::get('/admin/classroom/{id}', 'read');
        Route::post('/admin/classroom', 'create');
        Route::delete('/admin/classroom/{id}/delete', 'delete');
    });
});

Route::controller(AssignmentController::class)->group(function (){
    Route::middleware('role@admin')->group(function (){
        Route::get('/admin/assignment', 'index');
        Route::post('/admin/assignment/form', 'form');
        Route::post('/admin/assignment/', 'create');
    });
});