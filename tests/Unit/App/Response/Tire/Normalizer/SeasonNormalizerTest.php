<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;

use App\Response\Tire\Normalizer\SeasonNormalizer;
use App\Season\Entity\Season;
use App\Response\Tire\Normalizer\DesignNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SeasonNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $season = new Season();
        $season->setName('testName');

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new SeasonNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($season);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

    }
}