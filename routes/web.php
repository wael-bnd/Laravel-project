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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('user')->group(function(){
    Route::get('/logout','auth\LoginController@userLogout')->name('user.logout');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('user.profile');
    Route::get('/table', 'HomeController@table')->name('user.table');
    Route::get('/formation/{id}', 'HomeController@show_formation')->name('user.formation.show');
    Route::get('/edit-profile','CandidatController@edit')->name('user.edit-profile');
    Route::put('/update-profile','CandidatController@update')->name('user.update-profile');
});

Route::prefix('admin')->group(function(){

        Route::get('/login','auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login','auth\AdminLoginController@Login')->name('admin.login.submit');

        Route::get('/', 'AdminController@index')->name('admin.dashboard');
        Route::get('/gest-formateurs', 'AdminController@index_formateur')->name('admin.gestion.formateur');
        Route::get('/logout','auth\AdminLoginController@logout')->name('admin.logout');

        // route de la gestion de formateur
        Route::post('/add-formateur', 'AdminController@store_formateur')->name('admins.store_formateur');
        Route::PATCH('/update-formateur/{id}', 'AdminController@update_formateur')->name('admins.update_formateur');
        Route::delete('/delete-formateur/{id}', 'AdminController@destroy_formateur')->name('admins.destroy_formateur');
        Route::get('/inbox','InboxController@index_admin')->name('admin.inbox');
        Route::post('/inbox/store','InboxController@store_inbox_admin')->name('admin.inbox.store');   
          // route de la gestion de formateur
        Route::get('/gest-users', 'AdminController@index_user')->name('admin.gestion.user');
        Route::post('/add-user', 'AdminController@store_user')->name('admins.store_user');
        Route::PATCH('/update-user/{id}', 'AdminController@update_user')->name('admins.update_user');
        Route::delete('/delete-user/{id}', 'AdminController@destroy_user')->name('admins.destroy_user');

        
    });

Route::prefix('formateur')->group(function(){

    Route::get('/login','auth\FormateurLoginController@showLoginForm')->name('formateur.login');
    Route::post('/login','auth\FormateurLoginController@Login')->name('formateur.login.submit');
    
    Route::get('/register','auth\FormateurRegisterController@showRegisterForm')->name('formateur.register');
    Route::post('/register','auth\FormateurRegisterController@Register')->name('formateur.register.submit');
    
    Route::get('/', 'FormateurController@index')->name('formateur.dashboard');
    Route::get('/logout','auth\FormateurLoginController@logout')->name('formateur.logout');
    Route::get('/profile', 'FormateurController@showProfile')->name('formateur.profile');
    Route::get('/formation-list', 'FormateurController@showFormationTable')->name('formateur.formation.table');

    Route::get('/formation/create', 'FormationController@create')->name('formation.create');
    Route::post('/formation', 'FormationController@store')->name('formation.store');
    Route::get('/edit-profile','FormateurController@edit')->name('formateur.edit-profile');
    Route::put('/update-profile','FormateurController@update')->name('formateur.update-profile');

    // send message routes (inboxes)
    Route::get('/inbox','InboxController@index_formateur')->name('formateur.inbox');
    Route::post('/inbox/store','InboxController@store_inbox_formateur')->name('formateur.inbox.store');
   
    Route::delete('/delete-formation/{id}', 'FormationController@destroy')->name('formations.destroy');

     
     Route::get('/formation/edit/{id}', 'FormationController@edit')->name('formations.edit');
     Route::put('/update-formation/{id}', 'FormationController@update')->name('formations.update');
});