<?php

require_once __DIR__ . '/../src/version.php';

$clear = boolval(isset($_GET['clear']) ? $_GET['clear'] : false);
if (function_exists('opcache_reset') && $clear) {
    opcache_reset();
    // var_dump(opcache_get_status());
}

versions(['5.6', '7.1', '7.4', '8.0', '8.1', '8.2'], 'phpinfo');

phpinfo();
