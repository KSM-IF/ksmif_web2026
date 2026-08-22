<?php

namespace App\Http\Controllers;
use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;

//Route page
Route::get('/',[MainController::class, 'homepage']);
Route::get('/our-team',[MainController::class, 'getMember']);
Route::get('/gallery', [MainController::class, 'gallery']);
Route::get('/our-team/by',[MainController::class, 'getMemberBy']);
Route::get('/bursa-soal',[BursaSoalController::class, 'bursaSoal']);
Route::get('/bursa-soal/by', [BursaSoalController::class, 'bursaSoalBy']);

//User Login/signin
Route::post('/user-login', [UserLog::class, 'userLogin']);

//dashboad edit member
Route::get('/dashboard/editMember', [UserLog::class, 'editMember'])->middleware('checkMember');
Route::get('/dashboard/editMember/user/by', [UserLog::class, 'editMemberGetData'])->middleware('checkMember');
Route::patch('/dashboard/editMember/user/by',[UserLog::class, 'editMemberPatch'])->middleware('checkMember');
Route::delete('/dashboard/editMember/user/by', [UserLog::class, 'deleteUserData'])->middleware('checkMember');
Route::post('/dashboard/editMember/new', [UserLog::class, 'addMemberData'])->middleware('checkMember');
Route::get('/dashboard/newMember',[UserLog::class, 'newUserPage'])->middleware('checkMember');
Route::post('/dashboard/newMember', [UserLog::class, 'newUser'])->middleware('checkMember');

//dashboard edit bursa
Route::get('/dashboard/editBursa', [BursaSoalController::class, 'editBursa'])->middleware('checkMember');
Route::post('/dashboard/editBursa', [BursaSoalController::class, 'uploadSoal'])->middleware('checkMember');
Route::delete('/dashboard/editBursa',[BursaSoalController::class, 'deleteSoal'])->middleware('checkMember');

//dashboard adminer db
Route::match(['get','post'],'/dashboard/database',[MainController::class, 'database'])->middleware('checkMember');

//tesErr
Route::get('/err', [MainController::class, 'error']);