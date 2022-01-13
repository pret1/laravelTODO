<?php

use App\Models\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        //
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        //
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{task}', function (Task $task) {
        //
    });
});

