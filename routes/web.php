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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/mysitemap', 'SiteMapController@setSiteMap')->name('mysitemap');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::post('/admin/wysiwyg-media', 'WysiwygUploadController@uploads3')->name('brackets/admin-ui::wysiwyg-upload');
Route::post('upload', 'WysiwygUploadController@upload')->name('brackets/media::upload');

Route::post('feedback', 'HomeController@feedback')->name('feedback');

Route::get('users/{user}', 'UserController@edit')->name('users.edit');
Route::get('allFriends/{user}', 'UserController@allFriends')->name('users.allFriends');
Route::post('users/{user}', ['as' => 'users.update', 'uses' => 'UserController@update']);
Auth::routes();

Route::get('comments/{travelId}', 'CommentController@index')->name('comments');
Route::post('comments', 'CommentController@store')->name('commentssave');

Route::get('/like/{id}/islikedbyme', 'Travels\TravelsController@isLikedByMe')->name('islikedbyme');
Route::post('/like/{travelId}', 'Travels\TravelsController@like')->name('like');

Route::get('/save/{id}/isfavoritedbyme', 'Travels\TravelsController@isFavoritedByMe')->name('isfavoritedbyme');
Route::post('/save/{travelId}', 'Travels\TravelsController@addFavorite')->name('addFavorite');

Route::get('/location/cities', 'LocationController@getCities')->name('cities');
Route::get('/location/countries', 'LocationController@getCountries')->name('countries');
Route::get('/location/countriesCities', 'LocationController@getCitiesByCountries')->name('countriesCities');
Route::get('/travels/markers', 'TravelAddressController@getMarkers')->name('markers');

/* Sitemap */
Route::get('/sitemap', 'SitemapController@index');
Route::get('/sitemap/travels', 'SitemapController@travels');
Route::get('/sitemap/cities', 'SitemapController@cities');
Route::get('/sitemap/countries', 'SitemapController@countries');
Route::get('/sitemap/categories', 'SitemapController@categories');


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


Route::group(['namespace' => 'Travels', 'prefix' => 'travels', 'as' => 'travels.'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/metravel', 'TravelsController@metravel')->name('metravel');
        Route::get('/favoriteTravel', 'TravelsController@favoriteTravel')->name('favoriteTravel');
        Route::get('/friendtravel', 'TravelsController@friendTravel')->name('friendtravel');

        Route::get('/create', 'TravelsController@create')->name('create');
        Route::get('/{slug}/edit', 'TravelsController@edit')->name('edit');

        Route::post('/', 'TravelsController@store')->name('store');
        Route::post('/bulk-destroy', 'TravelsController@bulkDestroy')->name('bulk-destroy');
        Route::post('/{travel}', 'TravelsController@update')->name('update');

        Route::delete('/{travel}', 'TravelsController@destroy')->name('destroy');


    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('categories')->name('categories/')->group(static function () {
            Route::get('/', 'CategoriesController@index')->name('index');
            Route::get('/create', 'CategoriesController@create')->name('create');
            Route::post('/', 'CategoriesController@store')->name('store');
            Route::get('/{category}/edit', 'CategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{category}', 'CategoriesController@update')->name('update');
            Route::delete('/{category}', 'CategoriesController@destroy')->name('destroy');
        });
    });
});

Route::get('/travels', 'Travels\TravelsController@index')->name('index');
Route::get('/travelsby', 'Travels\TravelsController@indexby')->name('indexby');
Route::get('/travels/{slug}', 'Travels\TravelsController@show')->name('show');

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function () {
        Route::prefix('companions')->name('companions/')->group(static function () {
            Route::get('/', 'CompanionController@index')->name('index');
            Route::get('/create', 'CompanionController@create')->name('create');
            Route::post('/', 'CompanionController@store')->name('store');
            Route::get('/{companion}/edit', 'CompanionController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CompanionController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{companion}', 'CompanionController@update')->name('update');
            Route::delete('/{companion}', 'CompanionController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('comments')->name('comments/')->group(static function() {
            Route::get('/',                                             'CommentsController@index')->name('index');
            Route::get('/create',                                       'CommentsController@create')->name('create');
            Route::post('/',                                            'CommentsController@store')->name('store');
            Route::get('/{comment}/edit',                               'CommentsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CommentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{comment}',                                   'CommentsController@update')->name('update');
            Route::delete('/{comment}',                                 'CommentsController@destroy')->name('destroy');
        });
    });
});
