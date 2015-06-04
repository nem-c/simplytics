<?php

Route::group(['prefix' => 'simplytics'], function(){
    Route::get('/', 'NemC\Simplytics\Controllers\SimplyticsController@index');
    Route::get('/track', 'NemC\Simplytics\Controllers\SimplyticsController@store');
    Route::get('/sl.js', 'NemC\Simplytics\Controllers\SimplyticsController@script');
});