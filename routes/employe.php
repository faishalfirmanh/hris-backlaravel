<?php

use App\Http\Controllers\API\Employe\DetailEmployesController;
use App\Http\Controllers\API\Employe\EmployesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'employe'],function(){
   Route::get('', [EmployesController::class, 'index']);
   Route::post('/saved', [EmployesController::class, 'saved']);
   Route::post('/delete', [EmployesController::class, 'delete']);
   Route::post('/getAllData', [EmployesController::class, 'getAllData']);
   Route::post('/getById', [EmployesController::class, 'getById']);
  
   
   Route::prefix('details')->group(function () {
      Route::get('save', [DetailEmployesController::class, 'saved']);
  });

});
 