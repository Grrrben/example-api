<?php

namespace App\Tests\Request;

use App\Request\RequestParameters;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Request\RequestParameters
 */
final class RequestHandlerTest extends TestCase
{
    /**
     * @dataProvider getTestIsCode
     */
    public function testIsCodeSearch(string $path, bool $isCode): void
    {
        $handler = new RequestParameters($path);
        $this->assertSame($isCode, $handler->isCodeSearch());
    }

    /**
     * @dataProvider getTestQuerySets
     */
    public function testGetQuerySetByKey(string $path, string $key, string $value): void
    {
        $handler = new RequestParameters($path);

        $set = $handler->getQuerySetByKey($key);

        $this->assertSame($value, $set->value);
    }

    public function getTestQuerySets(): array
    {
        return [
            ['/github/user/grrrben', 'user', 'grrrben'],
            ['/github/user/grrrben/code/golang', 'code', 'golang'],
            ['/github/user/aap/code/banaan', 'user', 'aap'],
        ];
    }

    public function getTestIsCode(): array
    {
        return [
            ['/github/user/grrrben', false],
            ['/github/user/grrrben/code/golang', true],
            ['/github/user/aap/code/banaan', true],
        ];
    }
}
