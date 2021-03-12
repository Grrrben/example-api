<?php declare(strict_types = 1);

namespace App\Popo;

/**
 * @OA\Schema(
 *   schema="Hit",
 *   @OA\Property(property="name", type="string", readOnly="true", description="Name"),
 *   @OA\Property(property="path", type="string", readOnly="true", description="Path to the file"),
 *   @OA\Property(property="url", type="string", readOnly="true", description="Url to file"),
 *   @OA\Property(property="repos", description="repository", ref="#/components/schemas/Repo"),
 * )
 */
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