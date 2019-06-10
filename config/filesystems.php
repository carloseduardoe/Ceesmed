<?php

return [
  //Default Filesystem Disk --> The default disk that should be used.
  'default' => env('FILESYSTEM_DRIVER'),

  //Default Cloud Filesystem Disk --> You may specify a default "cloud" driver here.
  'cloud' => env('FILESYSTEM_CLOUD'),

  //Filesystem Disks --> Filesystem "disks", you can configure multiple disks for the same driver.
  //Supported Drivers: "local", "ftp", "s3", "rackspace"
  'disks' => [
    'local'  => [
      'driver'     => 'local',
      'root'       => storage_path('app'),
    ],
    'public' => [
      'driver'     => 'local',
      'root'       => storage_path('app/public'),
      'url'        => env('APP_URL').'/storage',
      'visibility' => 'public',
    ],
    's3'     => [
      'driver'     => 's3',
      'key'        => env('AWS_KEY'),
      'secret'     => env('AWS_SECRET'),
      'region'     => env('AWS_REGION'),
      'bucket'     => env('AWS_BUCKET'),
    ],
  ],
];
