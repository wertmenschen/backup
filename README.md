# Wertmenschen Backup

#### Require this package with composer

```shell
composer require wertmenschen/backup
```

#### Register the service provider

``` php
// config/app.php

'providers' => [
    ...
    Wertmenschen\Backup\BackupServiceProvider::class,
    ...
];
```

#### Create a webdav filesystem
``` php
// config/filesystems.php

'disks' => [
	...
	'webdav' => [
	    'driver'   => 'webdav',
	    'baseUri'  => 'https://mywebdavstorage.com',
	    'userName' => 'user',
	    'password' => 'password,
	],
	...
];
```

#### Publish the Spatie backup config file
```shell
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```

Spatie documentation: https://docs.spatie.be/laravel-backup/v4/installation-and-setup

#### Schedule backups
``` php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('backup:clean')->daily()->at('01:00');
   $schedule->command('backup:run')->daily()->at('02:00');
   $schedule->command('backup:run --only-db')->hourly();
}
```