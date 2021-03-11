<?php declare(strict_types = 1);

namespace App\Popo;

class Repo
{
    public string $name;
    public string $description;
    public string $url;

    /**
     * @OA\Schema(
     *   schema="Repo",
     *   @OA\Property(property="name", type="string", readOnly="true", description="Name"),
     *   @OA\Property(property="description", type="string", readOnly="true", description="A short description"),
     *   @OA\Property(property="url", type="string", readOnly="true", description="Repo url"),
     * )
     */
    public function __construct(string $name, string $description, string $url)
    {
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
    }
}
