<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Brand\Entity;

use App\Brand\Entity\Brand;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    public function testGetters()
    {
        $brand = new Brand();

        $helper = new TestPrivateHelper($brand);

        $helper->set('id', 1);
        $helper->set('name', 'test name');
        $helper->set('enabled',true);

        $this->assertEquals(1, $brand->getId());
        $this->assertEquals('test name', $brand->getName());
        $this->assertEquals(true, $brand->getEnabled());
    }

    public function testSetters()
    {
        $brand= new Brand();

        $brand->setName('test name');
        $this->assertEquals('test name', $brand->getName());

        $brand->setEnabled(false);
        $this->assertEquals(false, $brand->getEnabled());

    }


}