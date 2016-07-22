<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () 
{
    
	Route::get('/', 'Front@home');

     Route::post('/', 'Front@saverequest');
     Route::get('/joinrequest', 'Front@joinrequest');
	 Route::get('dropdown', 'Front@categoryDropDownData');

 	
	Route::get('/update','HomeController@updatechild');	
	Route::get('/deletechild/{getid}','HomeController@deletechild');	
	Route::get('/profile','Front@profile');	
	Route::get('/calender','Front@calender');	
	Route::get('/school_directory','HomeController@school_directory');
	Route::get('/showprofile/{getid}','HomeController@show_profile');
	Route::get('/printpdf','HomeController@printpdf');
	
	
	Route::get('/register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Front@confirm'
]);
	Route::post('/reg','Front@create_user');
	
	
	 Route::post('/uploadphotos', 'Front@uploadphotos');
     Route::get('/schoolphotos', 'Front@schoolphotos');
     Route::get('/showphotos', 'Front@showphotos');
	
});
 	
	
	
	Route::group(['middleware' => 'web'], function ()
	 {
		Route::auth();
		
		Route::get('/home', 'HomeController@ShowAppPage');
		Route::get('/childstatus', 'HomeController@childstatus');
		Route::post('/addchild','HomeController@addchild');
		Route::get('/childstatus/{getid}','HomeController@filldata');
		Route::get('/school_directory/{getid}','HomeController@showdata');
		Route::get('/getdata/{id}', 'HomeController@getdata');
		
		Route::get('/getevent','HomeController@getevent');
		
		Route::get('/app/settings/personal', 'HomeController@personal_settings');
		Route::post('app/settings/personal/change_password', 'HomeController@changePassword');
		Route::post('app/settings/personal/change_picture', 'HomeController@upload_profile');
		Route::get('/broadcast_message','HomeController@broadcast_message');

		Route::get('/broadcast_message/{id}','HomeController@show_user');
		Route::get('/group_message/{id}','HomeController@group_user');
		
		Route::get('/retrieveMessages', array('uses' => 'HomeController@retrieveMessages'));
		Route::get('/sendMsg', array('uses' => 'HomeController@sendMsg'));

		
		
		
	});
