<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;

use App\Response\Tire\Normalizer\SealingMethodNormalizer;
use App\Sealing\Entity\Sealing;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SealingMethodNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $sealing = new Sealing();
        $sealing->setName('testName');

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new SealingMethodNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($sealing);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

    }
}