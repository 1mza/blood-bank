<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DonationRequestController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/form-view',[HomeController::class,'form'] );
//Route::post('/form-store',[HomeController::class,'formstore'] );
//Route::get('/', function () {
//    return view('welcome');
//    Storage::disk('mostafa')->put('test.txt', 'Hello File test.text');
//    return 'OK File Saved';
//    return view('form');
//});

Route::group(['namespace' => 'Front'], function () {
    Route::view('/v-sign-up', 'front.create-account')->name('v-sign-up');
    Route::post('/sign-up', [AuthController::class, 'register'])->name('sign-up');
    Route::view('/v-sign-in', 'front.signin-account')->name('v-sign-in');
    Route::post('/sign-in', [AuthController::class, 'login'])->name('sign-in');

    Route::get('/', function () {
        if (auth('web-clients')->check()) {
            $favorites = auth('web-clients')->user()->favorites->pluck('id')->toArray();
            return view('front.home', compact('favorites'));
        } else {
            return view('front.home');
        }
    })->name('home');


    Route::view('/en', 'front.home-ltr');
    Route::get('/filter', [MainController::class, 'filter'])->name('filter');



    Route::get('/favorites', [MainController::class, 'favorites'])->name('favorites');
    Route::get('/articles', [MainController::class, 'articles'])->name('articles');
    Route::get('/articles/{id}', [MainController::class, 'article'])->name('article-details');
    Route::get('/donation-requests', [MainController::class, 'donationRequests'])->name('donation-requests');
    Route::get('/donation-requests/dr/{id}', [MainController::class, 'donationRequestDetails'])->name('donation-request-details');
    Route::get('/donation-requests/filter', [MainController::class, 'donationRequestsFilter'])->name('DR-filter');
    Route::view('/donation-requests/create', 'front.create-request')->name('createRequest');
    Route::post('/donation-requests/create/store', [MainController::class, 'storeRequest'])->name('storeRequest');
    Route::view('/about-us', 'front.about')->name('about-us');
    Route::view('/contact-us', 'front.contact-us')->name('contact-us');
    Route::post('/send-contacts', [MainController::class, 'sendContacts'])->name('send-contacts');

    Route::group(['middleware' => 'auth:web-clients'], function () {
        Route::post('/sign-out', [AuthController::class, 'signout'])->name('sign-out');
        Route::view('/profile', 'front.profile')->name('profile');
        Route::view('/profile/update', 'front.update-profile')->name('update-profile');
        Route::post('/profile/update/store', [MainController::class, 'updateProfile'])->name('store-update-profile');
    });
});


Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::group(['middleware' => 'role:owner|super-admin|admin|staff'], function () {

        Route::get('homeAdmin', [App\Http\Controllers\HomeController::class, 'homeAdmin']);
//        ->middleware('permission:users-delete');
        Route::resource('governorates', GovernorateController::class);
        Route::resource('cities', CityController::class);
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::get('roles/{id}/give-permission', [RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{id}/give-permission', [RoleController::class, 'givePermissionToRole']);
        Route::resource('permissions', PermissionController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('donation-requests', DonationRequestController::class);
        Route::resource('contacts', ContactController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('contact-us', ContactUsController::class);

    });
});
