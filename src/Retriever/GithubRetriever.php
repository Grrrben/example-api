<?php declare(strict_types = 1);

namespace App\Retriever;

use App\Request\RequestParameters;
use GuzzleHttp\Client;

class GithubRetriever implements RetrieverInterface
{
    const URL = 'https://api.github.com';

    private RequestParameters $requestParams;

    public function setup(RequestParameters $requestParams): RetrieverInterface
    {
        $this->requestParams = $requestParams;
        return $this;
    }

    public function fetch(): string
    {
        $headers = ['Accept' => 'application/vnd.github.v3+json'];
        $client = new Client(
            [
                'base_uri' => self::URL,
            ]
        );

        $uri = $this->uriBuilder();
        $response = $client->get($uri, $headers);

        if (substr((string)$response->getStatusCode(), 0, 1) !== '2') {
            throw new \Exception($response->getBody(), $response->getStatusCode());
        }

        return $response->getBody()->getContents();
    }

    private function uriBuilder(): string
    {
        if ($this->requestParams->isCodeSearch()) {
            // https://api.github.com/search/code?q=golang%20user:grrrben
            $user = $this->requestParams->getQuerySetByKey(RequestParameters::SEARCH_TYPE_USER);
            $code = $this->requestParams->getQuerySetByKey(RequestParameters::SEARCH_TYPE_CODE);
            $q = urlencode(sprintf('%s user:%s', $code->value, $user->value)); // $this->params->getSearchParameter());
            $uri = sprintf('/search/code?q=%s', $q);
        } else {
            // https://api.github.com/users/Grrrben/repos
            $user = $this->requestParams->getQuerySetByKey(RequestParameters::SEARCH_TYPE_USER);
            $uri = sprintf('/users/%s/repos', $user->value);
        }

        return $uri;
    }
}
