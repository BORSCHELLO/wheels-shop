<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;


use App\Response\Tire\Normalizer\ThornsNormalizer;
use App\Thorns\Entity\Thorns;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ThornsNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $thorns = new Thorns();
        $thorns->setName('testName');

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new ThornsNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($thorns);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

    }
}