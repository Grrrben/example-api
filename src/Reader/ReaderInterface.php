<?php declare(strict_types = 1);


namespace App\Reader;

use App\Request\RequestHandler;
use App\Popo\Platform;

interface ReaderInterface
{
    public function supports(string $type): bool;

    // todo should do something about the return type
    public function handle(RequestHandler $params): Platform;
}