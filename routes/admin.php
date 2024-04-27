<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\ResetPasswordBasic;
use App\Http\Controllers\RollsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\layouts\CollapsedMenu;
use App\Http\Controllers\layouts\ContentNavbar;
use App\Http\Controllers\layouts\ContentNavSidebar;
use App\Http\Controllers\layouts\NavbarFull;
use App\Http\Controllers\layouts\NavbarFullSidebar;
use App\Http\Controllers\layouts\Horizontal;
use App\Http\Controllers\layouts\Vertical;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\apps\UserList;
use App\Http\Controllers\apps\AccessRoles;
use App\Http\Controllers\apps\AccessPermission;
use App\Http\Controllers\cards\CardGamifications;

Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/auth-login', [LoginBasic::class, 'index'])->name('admin-auth-login');
Route::post('/auth-login', [LoginBasic::class, 'AdminLoginRequest'])->name('admin-auth-login-request');
Route::get('/auth-reset-password', [ResetPasswordBasic::class, 'index'])->name('admin-auth-reset-password');
Route::get('/auth-forgot-password', [ForgotPasswordBasic::class, 'index'])->name('admin-auth-forgot-password');
Route::post('/auth-reset-password', [ResetPasswordBasic::class, 'resetPassword'])->name('admin-auth-reset-password-request');
Route::get('/all-routes', [RollsController::class, 'AllRoutes'])->name('AllRoutes');
Route::get('/user-list', [UserList::class, 'allUserList'])->name('user-list');
// user Routes
Route::group(['prefix' => 'user'], function () {
  // API Routes
  Route::post('/store', [AdminController::class, 'user_store'])->name('user-store');
  Route::post('/update/{id}', [AdminController::class, 'user_update'])->name('user-update');
  Route::post('/delete', [AdminController::class, 'user_delete'])->name('user-delete');
  //View Routes
  Route::get('/list', [UserList::class, 'index'])->name('user-list');
  Route::get('/add', [AdminController::class, 'user_add'])->name('user-add');
  Route::get('/edit/{id}', [AdminController::class, 'user_edit'])->name('user-edit');
  Route::get('/view/{id}', [AdminController::class, 'user_view'])->name('user-view');
});
// role permission Routes
Route::group(['prefix' => 'roles'], function () {
  // API Routes
  Route::post('/store', [RollsController::class, 'roles_store'])->name('roles-store');
  Route::post('/update', [RollsController::class, 'roles_update'])->name('roles-update');
  Route::get('/delete/{id}', [RollsController::class, 'roles_delete'])->name('roles-delete');
  //View Routes
  Route::get('/', [AccessRoles::class, 'index'])->name('user-access-roles');
  Route::get('/data', [RollsController::class, 'rolesList'])->name('roles-list');
  Route::get('/permissions/{id}', [RollsController::class, 'rolesPermissionsList'])->name('roles-permissions-list');
  Route::get('/add', [RollsController::class, 'roles_add'])->name('roles-add');
  Route::get('/edit/{id}', [RollsController::class, 'roles_edit'])->name('roles-edit');
  Route::get('/view/{id}', [RollsController::class, 'roles_view'])->name('roles-view');
});
// member Routes
Route::group(['prefix' => 'member'], function () {
  // API Routes
  // Route::post('/store', [MemberController::class, 'member_store'])->name('member.store');
  // Route::post('/update/{id}', [MemberController::class, 'member_update'])->name('member.update');
  // Route::post('/delete', [MemberController::class, 'member_delete'])->name('member.delete');
  // //View Routes
  // Route::get('/', [MemberController::class, 'members'])->name('members');
  // Route::get('/add', [MemberController::class, 'member_add'])->name('member.add');
  // Route::get('/edit/{id}', [MemberController::class, 'member_edit'])->name('member.edit');
  // Route::get('/view/{id}', [MemberController::class, 'member_view'])->name('member.view');
});
