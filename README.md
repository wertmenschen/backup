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
    'webdav' => [
        'driver'   => 'webdav',
        'baseUri'  => env('BACKUP_URL'),
        'userName' => env('BACKUP_USERNAME'),
        'password' => env('BACKUP_PASSWORD'),
    ],
];
```

#### Optional: Publish the backup config file (overrides Spatie config)
```shell
php artisan vendor:publish --provider="Wertmenschen\Backup\BackupServiceProvider"
```

#### Set keys in .env
* BACKUP_URL
* BACKUP_USERNAME
* BACKUP_PASSWORD
* BACKUP_SLACK_WEBHOOK

#### Schedule backups
Spatie documentation: https://docs.spatie.be/laravel-backup/v4

``` php
// app/Console/Kernel.php

protected function schedule(Schedule $schedule)
{
   $schedule->command('backup:clean')->daily()->at('01:00');
   $schedule->command('backup:run')->daily()->at('02:00');
   $schedule->command('backup:run --only-db')->hourly();
   
   $schedule->command('backup:clean')->dailyAt(4);
   $schedule->command('backup:monitor')->dailyAt(5);
}
```