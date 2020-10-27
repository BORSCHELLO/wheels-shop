<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Response\Tire\Normalizer;


use App\Response\Tire\Normalizer\TireNormalizer;
use App\Tests\Unit\TestPrivateHelper;
use App\Tire\Entity\Tire;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TireNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $tire = new Tire();
        $helper = new TestPrivateHelper($tire);
        $tire->setName('testName')
            ->setWidth(200)
            ->setHeight(55)
            ->setDiameter(16)
            ->setDiscount(0)
            ->setSpeedIndex(210)
            ->setLoadIndex(94)
            ->setMarketLaunchDate(2020)
            ->setRating(4)
            ->setQuantity(5)
            ->setPrice(115)
        ;
        $helper->set('id',1);

        $normalizerMock = $this->createMock(NormalizerInterface::class);
        $normalizerMock->expects($this->any())
            ->method('normalize')
            ->willReturn('ok');

        $normalizer = new TireNormalizer();
        $normalizer->setNormalizer($normalizerMock);

        $normalized = $normalizer->normalize($tire);

        $this->assertArrayHasKey('id', $normalized);
        $this->assertEquals(1, $normalized['id']);

        $this->assertArrayHasKey('name', $normalized);
        $this->assertEquals('testName', $normalized['name']);

        $this->assertArrayHasKey('width', $normalized);
        $this->assertEquals(200, $normalized['width']);

        $this->assertArrayHasKey('height', $normalized);
        $this->assertEquals(55, $normalized['height']);

        $this->assertArrayHasKey('diameter', $normalized);
        $this->assertEquals(16, $normalized['diameter']);

        $this->assertArrayHasKey('discount', $normalized);
        $this->assertEquals(0, $normalized['discount']);

        $this->assertArrayHasKey('speedIndex', $normalized);
        $this->assertEquals(210, $normalized['speedIndex']);

        $this->assertArrayHasKey('loadIndex', $normalized);
        $this->assertEquals(94, $normalized['loadIndex']);

        $this->assertArrayHasKey('marketLaunchDate', $normalized);
        $this->assertEquals(2020, $normalized['marketLaunchDate']);

        $this->assertArrayHasKey('price', $normalized);
        $this->assertEquals(115, $normalized['price']);

        $this->assertArrayHasKey('rating', $normalized);
        $this->assertEquals(4, $normalized['rating']);

        $this->assertArrayHasKey('quantity', $normalized);
        $this->assertEquals(5, $normalized['quantity']);

    }
}