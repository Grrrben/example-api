<?php declare(strict_types = 1);

namespace App\Request;

class QuerySet
{
    public string $key;
    public string $value;

    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}