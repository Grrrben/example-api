<?php

namespace App;

require '../vendor/autoload.php';

use App\Reader\ReaderFactory;
use App\Router\Router;

header('Content-Type: application/json');

$reader = new ReaderFactory();
$r = new Router($reader);

echo $r->handle($_SERVER['REQUEST_URI']);
