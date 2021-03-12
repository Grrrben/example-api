<?php

namespace App\Tests\Router;

use App\Popo\Result;
use App\Reader\ReaderFactory;
use App\Request\RequestParameters;
use App\Router\Router;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Router\Router
 */
final class RouterTest extends TestCase
{
    const PATH = '/github/user/grrrben';

    public function testHandle(): void
    {
        $requestParams = new RequestParameters(self::PATH);

        $resp = new Result('github');
        $resp->count = 0;
        $resp->type = 'github';
        // which would result in:
        $expected = '{"count":0,"type":"github"}';

        /** @var MockObject|ReaderFactory $readerFactory */
        $readerFactory = $this->createMock(ReaderFactory::class);
        $readerFactory->expects($this->once())
            ->method("handle")
            ->with('github', $requestParams)
            ->willReturn($resp);

        $router = new Router($readerFactory);
        $actual = $router->handle(self::PATH);

        $this->assertEquals($expected, $actual);
    }
}
