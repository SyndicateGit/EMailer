<?php
# Make it easy to turn on/off debugging site-wide. 0 is off.
define('SITE_DEBUG', 0);

# Automatically load config.php.
require_once('config.php');

# Ensure that session_start() is always called...
ini_set('session.gc_maxlifetime', $CFG->session_timeout);
ini_set('session.cookie_lifetime', 0); // i.e., cookies are not permanent
session_start();

# Add support for PHP autoloading...
define('CLASS_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();
?>
