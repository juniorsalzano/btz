<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Database/Database.php';
require_once __DIR__ . '/../src/routes/Router.php';

function autoload_controllers($class_name) {
  $file = __DIR__ . '/../src/Controllers/' . $class_name . '.php';
  if (file_exists($file)) {
    require_once $file;
  }
}

spl_autoload_register('autoload_controllers');

$router = new Router();
require_once __DIR__ . '/../src/Routes/web.php';
$router->dispatch();