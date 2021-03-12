<?php declare(strict_types = 1);

namespace App\Reader;

use App\Popo\Result;
use App\Request\RequestParameters;

class ReaderFactory
{
    /**
     * @var ReaderInterface[] $strategies
     */
    private iterable $strategies;

    public function __construct()
    {
        // this needs to be autoloaded on interface, or in a config or something
        // for now, just add one Strategy
        $this->strategies = [
            new GithubReader()
        ];
    }

    public function handle(string $type, RequestParameters $params): Result
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($type)) {
                return $strategy->handle($params);
            }
        }

        throw new \Exception('no strategy found');
    }
}
