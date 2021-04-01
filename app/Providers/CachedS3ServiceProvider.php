<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Cached\Storage\Memory;
use League\Flysystem\Cached\Storage\Predis;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Cached\CachedAdapter;

class CachedS3ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('s3', function ($app, $config) {
            $adapter = $app['filesystem']->createS3Driver($config);
            $store = new Predis();

            return new Filesystem(new CachedAdapter($adapter->getDriver()->getAdapter(), $store));
        });
    }
}
