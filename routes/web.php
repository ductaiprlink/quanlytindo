<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
/*
 $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
   $this->post('login', 'Auth\LoginController@login');
   $this->post('logout', 'Auth\LoginController@logout')->name('logout');

   // Registration Routes...
   $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
   $this->post('register', 'Auth\RegisterController@register');
   // Password Reset Routes...
   $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
   $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
   $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
   $this->post('password/reset', 'Auth\ResetPasswordController@reset');
 */

Route::name('logout')->get('logout','Auth\LoginController@logout'); // Logout

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

Route::get('home', 'HomeController@index')->name('home');

Route::middleware(['AdminLogin', '2fa'])->prefix('admin')->group(function (){

    // Google 2FA
    Route::get('/2fa','PasswordSecurityController@show2faForm')->name('2fa');
    Route::post('/generate2faSecret','PasswordSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/2fa','PasswordSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa','PasswordSecurityController@disable2fa')->name('disable2fa');

    Route::get('2faVerify', function(){
        return redirect()->route('dashboard');
    });

    Route::post('/2faVerify', function () {
        return redirect()->route('dashboard');
    })->name('2faVerify');

    // -------------------------------------------- Trang chủ -------------------------------------------------------------
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('changePassword', 'HomeController@changePasswordForm')->name('changePasswordForm');
    Route::post('changePassword', 'HomeController@changePassword')->name('changePassword');

    // -------------------------------------------- TRỤ SỞ -------------------------------------------------------------
    Route::resource('departments', 'DepartmentController', ['except' => 'show', 'update'])->middleware(['permission:department-list|department-edit|department-create|department-delete']);
    Route::get('departments/create/introduced', 'DepartmentController@introduced')->name('departments.introduced');
    Route::post('departments/create', 'DepartmentController@store')->name('departments.store')->middleware(['permission:department-create']);
    Route::post('departments/{id}/edit', 'DepartmentController@update')->name('departments.update')->middleware(['permission:department-edit']);
    Route::get('departments/{id}', 'DepartmentController@destroy')->name('departments.destroy')->middleware(['permission:department-delete']);

    // address - ajax
    Route::get('departments/province/{pro_id}', 'DepartmentController@getDistrict');
    Route::get('departments/province/{pro_id}/district/{dis_id}', 'DepartmentController@getWard');


    // -------------------------------------------- CHỨC VỤ ------------------------------------------------------------
    Route::resource('positions', 'PositionController', ['except' => 'show', 'store', 'update'])->middleware(['permission:position-list|position-edit|position-create']);
    Route::post('positions/create', 'PositionController@store')->name('positions.store')->middleware(['permission:position-create']);
    Route::post('positions/{id}/edit', 'PositionController@update')->name('positions.update')->middleware(['permission:position-edit']);
    Route::get('positions/{id}', 'PositionController@destroy')->name('positions.destroy')->middleware(['permission:position-delete']);


    // -------------------------------------------- TRÌNH ĐỘ HỌC VẤN ---------------------------------------------------
    Route::resource('educations', 'EducationController', ['except' => 'show', 'store', 'update'])->middleware(['permission:education-list|education-edit|education-create']);
    Route::post('educations/create', 'EducationController@store')->name('educations.store')->middleware(['permission:education-create']);
    Route::post('educations/{id}/edit', 'EducationController@update')->name('educations.update')->middleware(['permission:education-edit']);
    Route::get('educations/{id}', 'EducationController@destroy')->name('educations.destroy')->middleware(['permission:education-delete']);


    // -------------------------------------------- TRÌNH TRẠNG HÔN NHÂN -----------------------------------------------
    Route::resource('marriages', 'MarriageController', ['except' => 'show', 'store', 'update'])->middleware(['permission:marriage-list|marriage-edit|marriage-create']);
    Route::post('marriages/create', 'MarriageController@store')->name('marriages.store')->middleware(['permission:marriage-create']);
    Route::post('marriages/{id}/edit', 'MarriageController@update')->name('marriages.update')->middleware(['permission:marriage-edit']);
    Route::get('marriages/{id}', 'MarriageController@destroy')->name('marriages.destroy')->middleware(['permission:marriage-delete']);


    // -------------------------------------------- TÍN ĐỒ -----------------------------------------------
    Route::get('employees/search', 'EmployeeController@search')->name('employees.search');
    Route::get('employees/filter', 'EmployeeController@filter')->name('employees.filter');
    Route::post('employees/searchAdvanced', 'EmployeeController@searchAdvanced')->name('employees.searchAdvanced');
    Route::get('employees/introduced', 'EmployeeController@createintroduced')->name('employees.createintroduced'); // auto complete nguoi gioi thieu
    Route::get('employees/downloadExcelSample', 'EmployeeController@downloadExcelSample')->name('employees.downloadExcelSample');
    Route::post('employees', 'EmployeeController@importEmployees')->name('employees.import');
    Route::resource('employees', 'EmployeeController', ['except' => 'store', 'update'])->middleware(['permission:employee-list|employee-edit|employee-create']);
    Route::post('employees/create', 'EmployeeController@store')->name('employees.store')->middleware(['permission:employee-create']);


    Route::get('employees/{id}/introduced', 'EmployeeController@introduced')->name('employees.introduced');
    Route::post('employees/{id}/edit', 'EmployeeController@update')->name('employees.update')->middleware(['permission:employee-edit']);
    Route::get('employees/{id}/delete', 'EmployeeController@destroy')->name('employees.destroy')->middleware(['permission:employee-delete']);

    // address - ajax
    Route::get('employees/province/{pro_id}', 'EmployeeController@getDistrict');
    Route::get('employees/province/{pro_id}/district/{dis_id}', 'EmployeeController@getWard');


    // -------------------------------------------- NGƯỜI ĐẠI DIỆN -------------------------------------------
    Route::get('presents', 'PresentationController@index')->name('presents.index');

    // -------------------------------------------- THÀNH TÍCH - KHUYẾT ĐIỂM -------------------------------------------
    Route::get('achievements/emp/{id}', 'AchievementController@index')->name('achievements.index')->middleware(['permission:achievement-list']);
    Route::get('achievements/emp/{id}/create', 'AchievementController@create')->name('achievements.create')->middleware(['permission:achievement-create']);
    Route::post('achievements/emp/{id}/create', 'AchievementController@store')->name('achievements.store')->middleware(['permission:achievement-create']);
    Route::get('achievements/emp/{id}/edit/{achie_id}', 'AchievementController@edit')->name('achievements.edit')->middleware(['permission:achievement-edit']);
    Route::post('achievements/emp/{id}/edit/{achie_id}', 'AchievementController@update')->name('achievements.update')->middleware(['permission:achievement-edit']);
    Route::get('achievements/emp/{id}/delete/{achie_id}', 'AchievementController@destroy')->name('achievements.destroy')->middleware(['permission:achievement-delete']);


    // -------------------------------------------- THÀNH VIÊN TRONG GIA ĐÌNH -------------------------------------------
    Route::get('members/emp/{id}', 'MemberController@index')->name('members.index')->middleware(['permission:member-list']);
    Route::get('members/emp/{id}/member', 'MemberController@member')->name('members.member');
    Route::get('members/emp/{id}/create', 'MemberController@create')->name('members.create')->middleware(['permission:member-create']);
    Route::post('members/emp/{id}/create', 'MemberController@store')->name('members.store')->middleware(['permission:member-create']);
    Route::get('members/emp/{id}/edit/{member_id}', 'MemberController@edit')->name('members.edit')->middleware(['permission:member-edit']);
    Route::post('members/emp/{id}/edit/{member_id}', 'MemberController@update')->name('members.update')->middleware(['permission:member-edit']);
    Route::get('members/emp/{id}/delete/{member_id}', 'MemberController@destroy')->name('members.destroy')->middleware(['permission:member-delete']);


    // -------------------------------------------- NHÓM VAI TRÒ -------------------------------------------
    Route::get('roles', 'RoleController@index')->name('roles.index')->middleware(['permission:role-list']);
    Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware(['permission:role-create']);
    Route::post('roles/create', 'RoleController@store')->name('roles.store')->middleware(['permission:role-create']);
    Route::get('roles/{id}', 'RoleController@show')->name('roles.show');
    Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit')->middleware('permission:role-edit');
    Route::post('roles/{id}/edit', 'RoleController@update')->name('roles.update')->middleware('permission:role-edit');
    Route::get('roles/{id}/destroy', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:role-delete');


    // -------------------------------------------- USERS -------------------------------------------
    Route::resource('users', 'UserController', ['except' => 'show', 'update', 'destroy'])->middleware(['permission:user-list|user-create|user-edit|user-delete']);
    Route::post('users/{id}/edit', 'UserController@update')->name('users.update')->middleware(['permission:user-edit']);
    Route::get('users/{id}/destroy', 'UserController@destroy')->name('users.destroy')->middleware(['permission:user-delete']);


    // -------------------------------------------- TEST -------------------------------------------
    Route::get('google2fa', 'Google2FAController@index')->name('google2fa');
    Route::post('google2fa', 'Google2FAController@active')->name('google2fa.active');

});