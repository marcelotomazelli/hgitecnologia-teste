<?php
/**
 * DATABASE
 */
define('CONF_DB_HOST', 'localhost');
define('CONF_DB_USER', 'root');
define('CONF_DB_PASS', '');
define('CONF_DB_NAME', 'management');

/**
 * PROJECT URLs
 */
define('CONF_URL_BASE', 'http://localhost/management');

/**
 * PASSWORD
 */
define('CONF_PASSWORD_MIN_LEN', 8);
define('CONF_PASSWORD_MAX_LEN', 40);
define('CONF_PASSWORD_ALGO', PASSWORD_DEFAULT);
define('CONF_PASSWORD_OPTION', ['cost' => 10]);

/**
 * VIEW
 */
define('CONF_VIEW_EXT', 'php');
define('CONF_VIEW_WEB', 'mngweb');
define('CONF_VIEW_ADMIN', 'mngadmin');
