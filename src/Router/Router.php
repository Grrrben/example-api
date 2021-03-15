<?php declare(strict_types = 1);

namespace App\Router;

use App\Reader\ReaderFactory;
use App\Request\RequestParameters;
use App\Response\Response;
use OpenApi\Annotations as OA;

class Router
{
    private ReaderFactory $reader;

    /** @var string[] */
    private array $routes;

    public function __construct(ReaderFactory $reader)
    {
        // this really is just here so I can create a proper unittest
        $this->reader = $reader;

        $this->routes = [
            '/github/' => 'github',
        ];
    }

    /**
     * @OA\Info(
     *         version="1.0.0",
     *         title="Example API",
     * )
     * @OA\Get(
     *     path="/{platform}/user/{username}",
     *     summary="Get repositories",
     *     description="Returns repositories of the given user",
     *     @OA\Parameter(
     *         description="Git platform (github|gitlab|bitbucket)",
     *         in="path",
     *         name="platform",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="github", summary="Github is a working integration."),
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         description="Github username",
     *         in="path",
     *         name="username",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="grrrben", summary="a valid Github username."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Result")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Not good"
     *     )
     * )
     */
    public function handle(string $path): string
    {
        // homepage will be API documentation
        if ($path === '/') {
            return file_get_contents("./../swagger.json");
        }

        try {
            foreach ($this->routes as $re => $route) {
                if (preg_match($re, $path)) {
                    $requestParams = new RequestParameters($path);
                    $output = $this->reader->handle($route, $requestParams);
                    return Response::json($output);
                }
            }
            throw new \Exception("no strategy found for {$path}");
        } catch (\Exception $e) {
            // log and ...
            $res = new \stdClass();
            $res->code = $e->getCode();
            $res->message = $e->getMessage();

            return Response::json($res);
        }
    }
}
