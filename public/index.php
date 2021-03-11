<?php

namespace App;

require '../vendor/autoload.php';

use App\Router\Router;

header('Content-Type: application/json');

$r = new Router();
echo $r->handle($_SERVER['REQUEST_URI']);

