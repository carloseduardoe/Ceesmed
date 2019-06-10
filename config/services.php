<?php

return [
  // Third Party Services --> This file is for storing the credentials for third party services.

  'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
  ],

  'ses' => [
    'key' => env('SES_KEY'),
    'secret' => env('SES_SECRET'),
    'region' => 'us-east-1',
  ],

  'sparkpost' => [
    'secret' => env('SPARKPOST_SECRET'),
  ],

  'stripe' => [
    'model' => CEM\User::class,
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
  ],
];
