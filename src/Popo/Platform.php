<?php declare(strict_types = 1);

namespace App\Popo;

class Platform
{
    /**
     * @OA\Schema(
     *   schema="Response",
     *   description="Number of results in the query",
     *   @OA\Property(property="reults", type="integer", readOnly="true", description="Number of results"),
     *   @OA\Property(property="type", type="string", readOnly="true", description="Type of integration/platform"),
     *   @OA\Property(property="repos",ref="#/components/schemas/Repo"),
     * )
     */
    public int $results;

    public string $type;

    /**
     * @var Repo[]
        */
    public array $repos;

    /** @var Hit[] */
    public array $hits;
}