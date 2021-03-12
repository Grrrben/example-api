<?php declare(strict_types = 1);

namespace App\Retriever;

use App\Request\RequestParameters;

interface RetrieverInterface
{
    public function fetch(): string;
    public function setup(RequestParameters $requestParams): RetrieverInterface;
}