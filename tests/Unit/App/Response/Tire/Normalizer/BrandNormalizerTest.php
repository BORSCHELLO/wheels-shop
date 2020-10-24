<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;


use App\Brand\Entity\Brand;
use App\Response\Tire\Normalizer\BrandNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BrandNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $brand = new Brand();
        $brand->setName('testName');

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new BrandNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($brand);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

    }
}