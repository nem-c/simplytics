<?php

Route::group(['prefix' => 'simplytics'], function(){
    Route::get('/', 'NemC\Simplytics\Controllers\SimplyticsController@index');
    Route::get('/track', 'NemC\Simplytics\Controllers\SimplyticsController@store');
    Route::get('/sl.js', 'NemC\Simplytics\Controllers\SimplyticsController@script');

    Route::get('/api/v1/clicks', 'NemC\Simplytics\Controllers\Api\V1\ClicksController@index');
    Route::get('/api/v1/impressions', 'NemC\Simplytics\Controllers\Api\V1\ImpressionsController@index');
});