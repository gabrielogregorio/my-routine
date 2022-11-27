<?php

define('APPNAME', 'My Daily Routine');
define('BASEURL', 'http://127.0.0.1:8000');

// Sessions
define('SESSION_STORAGE', dirname(__DIR__) . '/runtime/sessions/');

// Database Connection Credentials
define('HOSTNAME', 'MYSERVERNAME');
define('USERNAME', 'databaseUsername');
define('PASSWORD', 'yourPasswordHere');
define('DATABASE', 'yourDatabaseName');
define('PORT', 3310);
define('CHARSET', 'utf8mb4');

// Password
define('PASSWORD_MIN_LEN', 8);
define('PASSWORD_MAX_LEN', 50);
define('PASSWORD_ENCRYPT', PASSWORD_ARGON2ID);
define('PASSWORD_OPTIONS', ['cost' => 10]);
