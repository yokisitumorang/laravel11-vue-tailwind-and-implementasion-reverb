<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TransactionController;

Route::get(
    '/',
    function () {
        // return 'test'
        return Inertia::render(
            'Dashboard/Index',
            [
                'title' => 'Homepage',
            ]
        );
    }
)->name( 'homepage' );


Route::get(
    '/create',
    function () {
        // return 'test'
        return Inertia::render(
            'User/Create',
            [
                'title' => 'Homepage',
            ]
        );
    }
)->name( 'homepage' );


Route::post('/store', [TransactionController::class, 'store'])->name('store.data');

Route::post('/storeuser', [TransactionController::class, 'storeuser'])->name('storeuser.data');

Route::get('/get/data', [TransactionController::class, 'getdata'])->name('get.data');