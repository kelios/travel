<?php

namespace App\Providers;

use App\Repositories\Interfaces\TravelRepositoryInterface;
use App\Repositories\TravelRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TravelRepositoryInterface::class,
            TravelRelationRepositoryInterface::class,
            CategoryRepository::class,
            TravelRepository::class,
            CountyRepository::class,
            CityRepository::class,
            ComplexityRepository::class,
            MonthRepository::class,
            OverNightStayRepository::class,
            TransportRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
