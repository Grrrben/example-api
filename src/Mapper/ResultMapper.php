<?php declare(strict_types = 1);

namespace App\Mapper;

use App\Popo\Hit;
use App\Popo\Repo;
use App\Popo\Result;

class ResultMapper
{
    public static function fromGithub(string $response): Result
    {
        $json = json_decode($response);

        $result = new Result('github');
        $result->count = 0;

        if (isset($json->total_count)) {
            // code search...
            $result->count = $json->total_count;
            foreach ($json->items as $r) {
                $rep = $r->repository;
                $repo = new Repo($rep->name, (string)$rep->description, $rep->html_url);
                $hit = new Hit($r->name, $r->path, (string)$r->html_url, $repo);
                $result->hits[] = $hit;
            }
        } elseif (is_array($json)) {
            // user result
            $result->count = count($json);
            foreach ($json as $r) {
                $repo = new Repo($r->name, (string)$r->description, $r->html_url);
                $result->repos[] = $repo;
            }
        }

        return $result;
    }
}
