<?php
	
	use App\Http\Controllers\UserController;
	use Illuminate\Support\Facades\Route;
	
	Route::get('/',function(){
		return view('welcome');
		//return view('backend.pages.admin.auth.sign_in');
		
	});
	
	Route::prefix('users')->name('users.')->group(function(){
		
		Route::middleware(['guest:users', 'PreventBackHistory'])->group(function(){
			Route::view('/sign_in','backend.pages.admin.auth.sign_in')->name('sign_in');
			Route::post('/login_handler',[UserController::class,'loginHandler'])->name('login_handler');
			Route::view('/sign_up','backend.pages.admin.auth.sign_up')->name('sign_up');
			Route::post('/create',[UserController::class,'createUser'])->name('create');
		});
		
		Route::middleware(['auth:users', 'PreventBackHistory'])->group(function(){
			Route::view('/budget','frontend.pages.admin.budget')->name('budget');
			Route::post('/logout_handler',[UserController::class,'logoutHandler'])->name('logout_handler');
			
		});
	});
	
