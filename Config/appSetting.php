<?php

session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__DIR__) . DS);
define('APP', ROOT_PATH . "App" . DS);
define('VIEWS', APP . 'Views' . DS);
define('CONTROLLERS', APP . 'Controllers' . DS);
define('MODELS', APP . 'Models' . DS);
define('CORE', APP . "Core" . DS);
define('CONFIG', ROOT_PATH. "Config" . DS);
define('BASE_URL', "http://ecommerce.test/");