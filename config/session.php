<?php

return [
  /**
   * The session driver.
   *
   * Supported drivers: 'file', 'database', 'cookie'
   *
   * @var string
   */
  'driver' => env('SESSION_DRIVER', 'database'),

  /**
   * The session lifetime in minutes.
   * This determines how long a session will remain active before it expires. If set to 0, sessions will never expire.
   *
   * @var int
   */
  'lifetime' => 120,

  /**
   * The session files directory.
   * This is the directory where session files will be stored. If not set, the default storage directory will be used.
   *
   * @var string
   */
  'files' => storage_path('framework/sessions'),

  /**
   * The session cookie name.
   * This is the name of the cookie that will be used to store the session ID in the user's browser.
   *
   * @var string
   */
  'cookie' => 'pocketframe_session',

  /**
   * The session cookie path.
   * This is the path on the server where the cookie will be available. The default is '/' which means the cookie is available within the entire domain.
   *
   * @var string
   */
  'path' => '/',

  /**
   * The session cookie domain.
   * This is the domain that the cookie is available to. If not set, the cookie will be available to the current domain.
   *
   * @var string
   */
  'domain' => null,

  /**
   * The session cookie secure flag.
   * This indicates whether the cookie should only be sent over secure HTTPS connections. If set to true, the cookie will only be sent over HTTPS.
   *
   * @var bool
   */
  'secure' => false,

  /**
   * The session cookie httpOnly flag.
   * This indicates whether the cookie should be accessible only through the HTTP protocol. If set to true, the cookie will not be accessible via JavaScript.
   *
   * @var bool
   */
  'httpOnly' => true,

  /**
   * The session cookie sameSite flag.
   * This indicates whether the cookie should be sent with cross-site requests. Possible values are 'lax', 'strict', or null.
   *
   * @var string
   */
  'sameSite' => 'lax',

  /**
   * The session database connection.
   * This is the database connection that will be used for the 'database' session driver. If not set, the default database connection will be used.
   *
   * @var string
   */
  'connection' => env('DB_CONNECTION', 'default'),

  /**
   * The session database table.
   * This is the name of the database table that will be used to store session data when using the 'database' session driver. If not set, the default table name will be used.
   *
   * @var string
   */
  'table'      => 'sessions',
];
