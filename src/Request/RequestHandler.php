<?php declare(strict_types = 1);

namespace App\Request;

/**
 * Looks at the request URL and creates sets of query params
 * that can be used to query the platform
 */
class RequestHandler
{
    public const SEARCH_TYPE_USER = 'user';
    public const SEARCH_TYPE_CODE = 'code';

    // this only search on alphanum
    private const SEARCH_TYPES = [
        '/\/user\/([a-z0-9]+)/' => self::SEARCH_TYPE_USER,
        '/\/code\/([a-z0-9]+)/' => self::SEARCH_TYPE_CODE,
        ];

    /** @var QuerySet[] */
    private array $querySets;

    public function __construct(string $path)
    {
        $this->querySets = [];
        foreach (self::SEARCH_TYPES as $re => $type) {
            if (preg_match($re, $path, $matches)) {
                $param = $matches[1];
                $this->querySets[] = new QuerySet($type, $param);
            }
        }
    }

    /**
     * @return QuerySet[]
     */
    public function getQuerySets(): array
    {
        return $this->querySets;
    }

    public function isCodeSearch(): bool
    {
        foreach ($this->querySets as $set) {
            if ($set->key === self::SEARCH_TYPE_CODE) {
                return true;
            }
        }
        return false;
    }

    public function getQuerySetByKey(string $key): ?QuerySet
    {
        // if the key of the query is set as a key in the QuerySets array, it might make it a bit more efficient
        foreach ($this->querySets as $set) {
            if ($set->key === $key) {
                return $set;
            }
        }
        return null;
    }
}
