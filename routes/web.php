<?php 

use Novay\Nue\Features;
use Illuminate\Support\Facades\Cookie;

Route::group([
	'namespace' => 'App\Http\Controllers', 
	'middleware' => config('nue.route.middleware', ['web', 'nue']), 
	'prefix' => config('nue.route.prefix', '')
], function() {

	Route::get('lang/{flag?}', function($flag) {
        $languages = config('nue.locales');
        if(array_key_exists($flag, $languages)):
            Cookie::queue(Cookie::make('locale', $flag, (60 * 24 * 365 * 10)));
        endif;

        return redirect()->back();
	})->name('locale');

	Route::namespace('Auth')->group(function() {
		Route::get('login', 'LoginController@showLoginForm')->name('login');
		Route::post('login', 'LoginController@login');
		Route::post('logout', 'LoginController@logout')->name('logout');

		if(Features::enabled(Features::registration())):
			Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
			Route::post('register', 'RegisterController@register');
		endif;

		if(Features::enabled(Features::resetPasswords())):
			Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
			Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
			Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
			Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

			Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
			Route::post('password/confirm', 'ConfirmPasswordController@confirm');
		endif;

		if(Features::enabled(Features::emailVerification())):
			Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
			Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
			Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
		endif;
	});
	
	Route::namespace('Nue')->middleware(['auth'])->group(function() {
		if(Features::enabled(Features::updateProfile())):
			Route::prefix('profile')->group(function() {
				Route::get('/', 'ProfileController@show')->name('profile.show');
				Route::put('/', 'ProfileController@update')->name('profile.update');
			});
		endif;

		Route::prefix('users')->as('users.')->group(function() {
			Route::resource('roles', 'RoleController');
			Route::resource('permission', 'PermissionController');
			Route::resource('users', 'UserController');
		});

		Route::prefix('settings')->as('settings.')->group(function() {
			Route::resource('system', 'SystemController')->only(['index']);
			Route::resource('menu', 'MenuController')->except(['create']);
			Route::resource('audit', 'AuditController')->only(['index', 'destroy']);
		});
	});
});