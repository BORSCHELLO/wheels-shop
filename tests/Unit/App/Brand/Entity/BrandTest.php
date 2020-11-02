<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Brand\Entity;

use App\Brand\Entity\Brand;
use App\Tests\Unit\TestPrivateHelper;
use App\Tire\Entity\Tire;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    public function testGetters()
    {
        $brand = new Brand();
        $tire = new Tire();
        $helper = new TestPrivateHelper($brand);

        $helper->set('id', 1);
        $helper->set('name', 'test name');
        $helper->set('enabled', true);
        $helper->set('tire', $tire);

        $this->assertEquals(1, $brand->getId());
        $this->assertEquals('test name', $brand->getName());
        $this->assertEquals(true, $brand->getEnabled());
        $this->assertEquals($tire, $brand->getTire());
    }

    public function testSetters()
    {
        $brand= new Brand();
        $tire = new Tire();

        $brand->setName('test name');
        $this->assertEquals('test name', $brand->getName());

        $brand->setEnabled(false);
        $this->assertEquals(false, $brand->getEnabled());

        $brand->setTire($tire);
        $this->assertEquals($tire, $brand->getTire());
    }


}