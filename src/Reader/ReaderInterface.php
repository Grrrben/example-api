<?php declare(strict_types = 1);


namespace App\Reader;

use App\Popo\Result;
use App\Request\RequestParameters;

interface ReaderInterface
{
    public function supports(string $type): bool;

    // todo should do something about the return type
    public function handle(RequestParameters $params): Result;
}