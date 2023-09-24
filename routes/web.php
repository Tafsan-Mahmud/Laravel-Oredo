<?php

use App\Http\Controllers\Categorycontroller;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Tagcontroller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route:get('/',[FrontendController]::class,'welcome');

Route::get('/', [FrontendController::class, 'welcome']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//user oparetion//

Route::get('/all/user', [UserController::class, 'users'])->name('users');
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/update/profile/image', [UserController::class, 'update_profile_image'])->name('update.profile.image');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::post('/delete/checkbox/user', [UserController::class, 'delete_checkbox'])->name('delete.checkbox');
Route::get('/trash/user', [UserController::class, 'trash_user'])->name('users.trash');
Route::get('/user/restore/{user_id}', [UserController::class, 'user_restore'])->name('user.restore');
Route::get('/user/hard/delete/{user_id}', [UserController::class, 'user_hard_delete'])->name('user.hard.delete');
Route::post('/hard/delete/checkbox', [UserController::class, 'hard_delete_checkbox'])->name('hard.delete.checkbox');


// Category oparetion

Route::get('/new/category', [Categorycontroller::class, 'new_category'])->name('new.category');
Route::post('/store/new/category', [Categorycontroller::class, 'store_new_category'])->name('store.new.category');
Route::get('/delete/category/{cat_id}', [Categorycontroller::class, 'delete_category'])->name('delete.category');
Route::get('/edit/category/{cat_id}', [Categorycontroller::class, 'edit_category'])->name('edit.category');
Route::post('/store/edited/category', [Categorycontroller::class, 'store_edited_category'])->name('store.edited.category');


// Tag Oparetion

Route::get('/tag', [Tagcontroller::class, 'tag'])->name('tag');
Route::post('/store/new/tag', [Tagcontroller::class, 'store_new_tag'])->name('store.new.tag');
Route::get('/delete/tag/{tag_id}', [Tagcontroller::class, 'delete_tag'])->name('delete.tag');


// Role Management

Route::get('/role/management', [RoleController::class,'role_management'])->name('role.management');
Route::post('/permission/store', [RoleController::class,'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class,'role_store'])->name('role.store');
Route::post('/asign/role', [RoleController::class,'asign_role'])->name('asign.role');
Route::get('/remove/role/user/{user_id}', [RoleController::class, 'remove_role_user'])->name('remove.role.user');
Route::get('/edit/user/permission/{user_id}', [RoleController::class, 'edit_user_permission'])->name('edit.user.permission');
Route::post('/update/user/permission', [RoleController::class, 'update_user_permission'])->name('update.user.permission');
