<?php

namespace Wertmenschen\Backup;

use Illuminate\Support\ServiceProvider;
use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\WebDAV\WebDAVAdapter;
use Sabre\DAV\Client as WebDAVClient;

class BackupServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(\Spatie\Backup\BackupServiceProvider::class);

        Storage::extend('webdav', function ($app, $config) {
            $client = new WebDAVClient($config);
            $adapter = new WebDAVAdapter($client);
            return new Filesystem($adapter);
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}