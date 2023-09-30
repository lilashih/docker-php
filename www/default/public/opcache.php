<?php

ob_start();

require_once __DIR__ . '/../src/version.php';

versions(['7.4', '8.0', '8.1', '8.2'], 'opcache');

require_once __DIR__ . '/../vendor/amnuts/opcache-gui/index.php';

ob_end_flush();