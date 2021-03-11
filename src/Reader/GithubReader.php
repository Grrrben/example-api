<?php declare(strict_types = 1);

namespace App\Reader;

use App\Popo\Hit;
use App\Request\RequestHandler;
use App\Popo\Platform;
use App\Popo\Repo;
use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

class GithubReader implements ReaderInterface
{
    const TYPE = 'github';
    const URL = 'https://api.github.com';

    private RequestHandler $params;

    public function supports(string $type): bool
    {
        return $type === self::TYPE;
    }

    public function handle(RequestHandler $params): Platform
    {
        $this->params = $params;

        $response = $this->fetch();
        $content = json_decode($response->getContents());

        $platform = new Platform();
        $platform->type = self::TYPE;
        $platform->results = 0;

        // todo mappers
        if (isset($content->total_count)) {
            // code search...
            $platform->results = $content->total_count;
            foreach ($content->items as $r) {

                $rep = $r->repository;

                $repo = new Repo($rep->name, (string)$rep->description, $rep->html_url);
                $hit = new Hit($r->name, $r->path, (string)$r->html_name, $repo);
                $platform->hits[] = $hit;
            }
        } elseif (is_array($content)) {
            // user result
            $platform->results = count($content);
            foreach ($content as $r) {
                $repo = new Repo($r->name, (string)$r->description, $r->html_url);
                $platform->repos[] = $repo;
            }
        }

        return $platform;
    }

    private function fetch(): StreamInterface
    {
        $headers = ['Accept' => 'application/vnd.github.v3+json'];
        $client = new Client(
            [
                'base_uri' => self::URL,
            ]
        );

        $uri = $this->uriBuilder();
        $response = $client->get($uri, $headers);

        return $response->getBody();
    }

    /**
     * todo own class
     * @return string
     */
    private function uriBuilder(): string
    {
        // const queryString = 'q=' + encodeURIComponent('GitHub Octocat in:readme user:defunkt');
        // https://api.github.com/users/Grrrben/repos

        if ($this->params->isCodeSearch()) {
            // https://api.github.com/search/code?q=golang%20user:grrrben
            $user = $this->params->getQuerySetByKey(RequestHandler::SEARCH_TYPE_USER);
            $code = $this->params->getQuerySetByKey(RequestHandler::SEARCH_TYPE_CODE);
            $q = urlencode(sprintf('%s user:%s', $code->value, $user->value)); // $this->params->getSearchParameter());
            $uri = sprintf('/search/code?q=%s', $q);
        } else {
            $user = $this->params->getQuerySetByKey(RequestHandler::SEARCH_TYPE_USER);
            $uri = sprintf('/users/%s/repos', $user->value);
        }

        return $uri;
    }
}