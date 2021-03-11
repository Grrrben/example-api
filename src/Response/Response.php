<?php declare(strict_types = 1);

namespace App\Response;

class Response
{
    public static function json(object $data): string {
        return json_encode($data);
    }
}