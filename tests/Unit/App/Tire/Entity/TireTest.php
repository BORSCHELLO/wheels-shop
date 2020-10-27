<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Tire\Entity;

use App\Brand\Entity\Brand;
use App\Category\Entity\Category;
use App\Tire\Entity\Tire;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class TireTest extends TestCase
{
    public function testAll()
    {
        $tire = new Tire();
        $brand = new Brand();
        $category = new Category();


        $helper = new TestPrivateHelper($tire);
        $helper->set('id', 1);

        $tire->setName('test name');
        $tire->setBrand( $brand);
        $tire->setCategory($category);
        $tire->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire->setStuds(Tire::STUDS_WITHOUT);
        $tire->setSeason(Tire::SEASON_MEDIUM);
        $tire->setEnabled(true);
        $tire->setDiscount(0);
        $tire->setRating(4.5);
        $tire->setQuantity(5);
        $tire->setPrice(115.5);
        $tire->setLoadIndex(94);
        $tire->setSpeedIndex(210);
        $tire->setDiameter(16);
        $tire->setHeight(55);
        $tire->setWidth(205);
        $tire->setMarketLaunchDate(2020);

        $this->assertEquals(1, $tire->getId());
        $this->assertEquals('test name', $tire->getName());
        $this->assertEquals($brand, $tire->getBrand());
        $this->assertEquals($category, $tire->getCategory());
        $this->assertEquals(Tire::SEALING_METHOD_TUBELESS, $tire->getSealingMethod());
        $this->assertEquals(Tire::STUDS_WITHOUT, $tire->getStuds());
        $this->assertEquals(Tire::SEASON_MEDIUM, $tire->getSeason());
        $this->assertEquals(true, $tire->getEnabled());
        $this->assertEquals(0, $tire->getDiscount());
        $this->assertEquals(4.5, $tire->getRating());
        $this->assertEquals(5, $tire->getQuantity());
        $this->assertEquals(115.5, $tire->getPrice());
        $this->assertEquals(94, $tire->getLoadIndex());
        $this->assertEquals(210, $tire->getSpeedIndex());
        $this->assertEquals(16, $tire->getDiameter());
        $this->assertEquals(55, $tire->getHeight());
        $this->assertEquals(205, $tire->getWidth());
        $this->assertEquals(2020, $tire->getMarketLaunchDate());
    }

    public function testInvalidSealingMethodSet()
    {
        $this->expectException(\InvalidArgumentException::class);

        $tire = new Tire();
        $tire->setSealingMethod('dsfasdfasdfasdfafd');
    }

    /**
     * @dataProvider getMethods
     */
    public function testValidSealingMethodSet(string $method)
    {
        $tire = new Tire();
        $tire->setSealingMethod($method);

        $this->assertEquals($method, $tire->getSealingMethod());
    }

    public function getMethods(): array
    {
        return array_map(function(string $method) {
            return [$method];
        }, Tire::SEALING_METHODS);
    }
}