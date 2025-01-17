<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\Api\FileControllerV0;
use App\Http\Controllers\Api\FileControllerV1;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/replies/{threadId}',[ReplyController::class,'getReplies'])->name('api.replies');

Route::get('/getCsv',[FileControllerV0::class,'getCsv'])->name('api.get.csv');

Route::post('/getCsvWhere',[FileControllerV1::class,'getCsvWhereV2'])->name('api.where.csv');

Route::post('/importUserCsv',[FileControllerV0::class,'userCsvImport'])->name('api.import.user.csv');

Route::post('/importCsv',[FileControllerV0::class,'importCsv'])->name('api.import.csv');