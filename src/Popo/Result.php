<?php declare(strict_types = 1);

namespace App\Popo;

/**
 * @OA\Schema(
 *   schema="Result",
 *   @OA\Property(property="count", type="integer", readOnly="true", description="Number of results"),
 *   @OA\Property(property="target", type="string", readOnly="true", description="Type of integration/platform"),
 *   @OA\Property(property="repos",ref="#/components/schemas/Repo"),
 *   @OA\Property(property="hits",ref="#/components/schemas/Hit"),
 * )
 */
class Result
{
    public int $count;
    public string $type;

    /** @var Repo[] */
    public array $repos;

    /** @var Hit[] */
    public array $hits;

    public function __construct(string $type)
    {
        $this->type = $type;
    }
}