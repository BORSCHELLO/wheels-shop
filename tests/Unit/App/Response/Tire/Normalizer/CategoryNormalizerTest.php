<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;

use App\Category\Entity\Category;
use App\Response\Tire\Normalizer\CategoryNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CategoryNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $category = new Category();
        $category->setName('testName');

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new CategoryNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($category);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

    }
}