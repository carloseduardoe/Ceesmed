<?php

return [
  // Mail Driver --> "smtp", "sendmail", "mailgun", "mandrill", "ses", "sparkpost", "log", "array"
  'driver' => env('MAIL_DRIVER'),

  // SMTP Host Address --> Host address of the SMTP server used by your applications.
  'host' => env('MAIL_HOST'),

  // SMTP Host Port --> SMTP port used by your application to deliver e-mails.
  'port' => env('MAIL_PORT'),

  // Global "From" Address --> Name and address used globally for all e-mails being sent.
  'from' => [
    'address' => env('MAIL_FROM_ADDRESS'),
    'name' => env('MAIL_FROM_NAME'),
  ],

  // E-Mail Encryption Protocol --> Encryption protocol used. transport layer security should be ok.
  'encryption' => env('MAIL_ENCRYPTION'),

  // SMTP Server Username --> If your SMTP server uses authentication, you should set it up here.
  'username' => env('MAIL_USERNAME'),
  'password' => env('MAIL_PASSWORD'),

  // Sendmail System Path --> When using the "sendmail" driver, it is the path to where it lives on this server.
  'sendmail' => '/usr/sbin/sendmail -bs',

  // Markdown Mail Settings --> When using Markdown based email, configure your theme and paths here.
  'markdown' => [
    'theme' => 'bootstrap',
    'paths' => [
      resource_path('views/mail'),
      resource_path('views/vendor/mail'),
    ],
  ],
];
