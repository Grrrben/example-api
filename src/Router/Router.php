<?php declare(strict_types = 1);

namespace App\Router;

use App\Request\RequestHandler;
use App\Reader\ReaderFactory;
use App\Response\Response;
use OpenApi\Annotations as OA;

class Router
{
    /** @var string[] */
    private array $routes;

    public function __construct()
    {
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
     *     path="/platform/user/username",
     *     summary="Returns repositories of the given user",
     *     description="Returns repositories of the given user",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Response")
     *         ),
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

        $reader = new ReaderFactory();

        foreach ($this->routes as $re => $route) {
            if (preg_match($re, $path)) {
                $params = $reqHandler = new RequestHandler($path);
                $output = $reader->handle($route, $params);
                return Response::json($output);
            }
        }

        throw new \RuntimeException("no strategy found for {$path}");
    }
}
