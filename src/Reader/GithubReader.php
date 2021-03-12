<?php declare(strict_types = 1);

namespace App\Reader;

use App\Mapper\ResultMapper;
use App\Popo\Result;
use App\Request\RequestParameters;
use App\Retriever\GithubRetriever;
use App\Retriever\RetrieverInterface;

class GithubReader implements ReaderInterface
{
    public const TYPE = 'github';

    private RetrieverInterface $retriever;

    public function __construct()
    {
        $this->retriever = new GithubRetriever();
    }

    public function supports(string $type): bool
    {
        return $type === self::TYPE;
    }

    public function setRetriever(RetrieverInterface $retriever)
    {
        $this->retriever = $retriever;
    }

    public function handle(RequestParameters $params): Result
    {
        $response = $this->retriever->setup($params)->fetch();

        return ResultMapper::fromGithub($response);
    }
}
