<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/', 'AdminUsersController@index')->name('index');
            Route::get('/create', 'AdminUsersController@create')->name('create');
            Route::post('/', 'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login', 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit', 'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}', 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}', 'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation', 'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::get('/profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password', 'ProfileController@editPassword')->name('edit-password');
        Route::post('/password', 'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('users')->name('users/')->group(static function () {
            Route::get('/', 'UsersController@index')->name('index');
            Route::get('/create', 'UsersController@create')->name('create');
            Route::post('/', 'UsersController@store')->name('store');
            Route::get('/{user}/edit', 'UsersController@edit')->name('edit');
            Route::post('/bulk-destroy', 'UsersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{user}', 'UsersController@update')->name('update');
            Route::delete('/{user}', 'UsersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('category-travels')->name('category-travels/')->group(static function () {
            Route::get('/', 'CategoryTravelController@index')->name('index');
            Route::get('/create', 'CategoryTravelController@create')->name('create');
            Route::post('/', 'CategoryTravelController@store')->name('store');
            Route::get('/{categoryTravel}/edit', 'CategoryTravelController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CategoryTravelController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{categoryTravel}', 'CategoryTravelController@update')->name('update');
            Route::delete('/{categoryTravel}', 'CategoryTravelController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('transports')->name('transports/')->group(static function () {
            Route::get('/', 'TransportController@index')->name('index');
            Route::get('/create', 'TransportController@create')->name('create');
            Route::post('/', 'TransportController@store')->name('store');
            Route::get('/{transport}/edit', 'TransportController@edit')->name('edit');
            Route::post('/bulk-destroy', 'TransportController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{transport}', 'TransportController@update')->name('update');
            Route::delete('/{transport}', 'TransportController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('complexities')->name('complexities/')->group(static function () {
            Route::get('/', 'ComplexityController@index')->name('index');
            Route::get('/create', 'ComplexityController@create')->name('create');
            Route::post('/', 'ComplexityController@store')->name('store');
            Route::get('/{complexity}/edit', 'ComplexityController@edit')->name('edit');
            Route::post('/bulk-destroy', 'ComplexityController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{complexity}', 'ComplexityController@update')->name('update');
            Route::delete('/{complexity}', 'ComplexityController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('cities')->name('cities/')->group(static function () {
            Route::get('/', 'CityController@index')->name('index');
            Route::get('/create', 'CityController@create')->name('create');
            Route::post('/', 'CityController@store')->name('store');
            Route::get('/{city}/edit', 'CityController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CityController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{city}', 'CityController@update')->name('update');
            Route::delete('/{city}', 'CityController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('countries')->name('countries/')->group(static function () {
            Route::get('/', 'CountryController@index')->name('index');
            Route::get('/create', 'CountryController@create')->name('create');
            Route::post('/', 'CountryController@store')->name('store');
            Route::get('/{country}/edit', 'CountryController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CountryController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{country}', 'CountryController@update')->name('update');
            Route::delete('/{country}', 'CountryController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('cities')->name('cities/')->group(static function () {
            Route::get('/', 'CitiesController@index')->name('index');
            Route::get('/create', 'CitiesController@create')->name('create');
            Route::post('/', 'CitiesController@store')->name('store');
            Route::get('/{city}/edit', 'CitiesController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CitiesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{city}', 'CitiesController@update')->name('update');
            Route::delete('/{city}', 'CitiesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('countries')->name('countries/')->group(static function () {
            Route::get('/', 'CountriesController@index')->name('index');
            Route::get('/create', 'CountriesController@create')->name('create');
            Route::post('/', 'CountriesController@store')->name('store');
            Route::get('/{country}/edit', 'CountriesController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CountriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{country}', 'CountriesController@update')->name('update');
            Route::delete('/{country}', 'CountriesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('months')->name('months/')->group(static function () {
            Route::get('/', 'MonthController@index')->name('index');
            Route::get('/create', 'MonthController@create')->name('create');
            Route::post('/', 'MonthController@store')->name('store');
            Route::get('/{month}/edit', 'MonthController@edit')->name('edit');
            Route::post('/bulk-destroy', 'MonthController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{month}', 'MonthController@update')->name('update');
            Route::delete('/{month}', 'MonthController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('over-night-stays')->name('over-night-stays/')->group(static function () {
            Route::get('/', 'OverNightStayController@index')->name('index');
            Route::get('/create', 'OverNightStayController@create')->name('create');
            Route::post('/', 'OverNightStayController@store')->name('store');
            Route::get('/{overNightStay}/edit', 'OverNightStayController@edit')->name('edit');
            Route::post('/bulk-destroy', 'OverNightStayController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{overNightStay}', 'OverNightStayController@update')->name('update');
            Route::delete('/{overNightStay}', 'OverNightStayController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('travels')->name('travels/')->group(static function () {
            Route::get('/', 'TravelsController@index')->name('index');
            Route::get('/create', 'TravelsController@create')->name('create');
            Route::post('/', 'TravelsController@store')->name('store');
            Route::get('/{travel}/edit', 'TravelsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'TravelsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{travel}', 'TravelsController@update')->name('update');
            Route::delete('/{travel}', 'TravelsController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('travels')->name('travels/')->group(static function () {
            Route::get('/', 'TravelsController@index')->name('index');
            Route::get('/create', 'TravelsController@create')->name('create');
            Route::post('/', 'TravelsController@store')->name('store');
            Route::get('/{travel}/edit', 'TravelsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'TravelsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{travel}', 'TravelsController@update')->name('update');
            Route::delete('/{travel}', 'TravelsController@destroy')->name('destroy');
        });
    });
});


Route::group(['namespace' => 'travels', 'prefix' => 'travels', 'as' => 'travels.'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'TravelsController@index')->name('index');
        Route::get('/create', 'TravelsController@create')->name('create');
        Route::post('/', 'TravelsController@store')->name('store');
        Route::get('/{travel}/edit', 'TravelsController@edit')->name('edit');
        Route::post('/bulk-destroy', 'TravelsController@bulkDestroy')->name('bulk-destroy');
        Route::post('/{travel}', 'TravelsController@update')->name('update');
        Route::delete('/{travel}', 'TravelsController@destroy')->name('destroy');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('travels')->name('travels/')->group(static function () {
            Route::get('/', 'TravelsController@index')->name('index');
            Route::get('/create', 'TravelsController@create')->name('create');
            Route::post('/', 'TravelsController@store')->name('store');
            Route::get('/{travel}/edit', 'TravelsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'TravelsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{travel}', 'TravelsController@update')->name('update');
            Route::delete('/{travel}', 'TravelsController@destroy')->name('destroy');
        });
    });
});
