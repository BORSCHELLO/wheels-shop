<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;

use App\Design\Entity\Design;
use App\Response\Tire\Normalizer\DesignNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DesignNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $design = new Design();
        $design->setName('testName');

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new DesignNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($design);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

    }
}