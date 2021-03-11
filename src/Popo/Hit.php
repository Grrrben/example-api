<?php declare(strict_types = 1);

namespace App\Popo;

class Hit
{
    public string $url;
    public string $name;
    public string $path;
    public Repo $repo;

    public function __construct(string $name, string $path, string $url, Repo $repo)
    {
        $this->url = $url;
        $this->name = $name;
        $this->path = $path;
        $this->repo = $repo;
    }
}