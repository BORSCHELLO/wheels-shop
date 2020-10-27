<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Tire\Entity;

use App\Brand\Entity\Brand;
use App\Category\Entity\Category;
use App\Design\Entity\Design;
use App\Sealing\Entity\Sealing;
use App\Season\Entity\Season;
use App\Thorns\Entity\Thorns;
use App\Tire\Entity\Tire;
use App\Tests\Unit\TestPrivateHelper;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class TireTest extends TestCase
{
    public function testGetters()
    {
        $tire = new Tire();
        $brand = new Brand();
        $category = new Category();
        $season = new Season();
        $design = new Design();
        $sealing_method = new Sealing();
        $thorns = new Thorns();
        $images = new ArrayCollection();

        $helper = new TestPrivateHelper($tire);

        $helper->set('id', 1);
        $helper->set('name', 'test name');
        $helper->set('brand', $brand);
        $helper->set('category', $category);
        $helper->set('season', $season);
        $helper->set('design', $design);
        $helper->set('sealing_method', $sealing_method);
        $helper->set('thorns', $thorns);
        $helper->set('images', $images);
        $helper->set('enabled', true);
        $helper->set('discount', 0);
        $helper->set('rating', 4);
        $helper->set('quantity', 5);
        $helper->set('price', 115);
        $helper->set('loadIndex', 94);
        $helper->set('speedIndex', 210);
        $helper->set('diameter', 16);
        $helper->set('height', 55);
        $helper->set('width', 205);
        $helper->set('marketLaunchDate', 2020);

        $this->assertEquals(1, $tire->getId());
        $this->assertEquals('test name', $tire->getName());
        $this->assertEquals($brand, $tire->getBrand());
        $this->assertEquals($category, $tire->getCategory());
        $this->assertEquals($season, $tire->getSeason());
        $this->assertEquals($design, $tire->getDesign());
        $this->assertEquals($sealing_method, $tire->getSealingMethod());
        $this->assertEquals($thorns, $tire->getThorns());
        $this->assertEquals($images, $tire->getImages());
        $this->assertEquals(true, $tire->getEnabled());
        $this->assertEquals(0, $tire->getDiscount());
        $this->assertEquals(4, $tire->getRating());
        $this->assertEquals(5, $tire->getQuantity());
        $this->assertEquals(115, $tire->getPrice());
        $this->assertEquals(2020, $tire->getMarketLaunchDate());
        $this->assertEquals(94, $tire->getLoadIndex());
        $this->assertEquals(210, $tire->getSpeedIndex());
        $this->assertEquals(16, $tire->getDiameter());
        $this->assertEquals(55, $tire->getHeight());
        $this->assertEquals(205, $tire->getWidth());
    }

    public function testSetters()
    {
        $tire = new Tire();
        $brand = new Brand();
        $category = new Category();
        $season = new Season();
        $design = new Design();
        $sealing_method = new Sealing();
        $thorns = new Thorns();


        $tire->setName('test name');
        $tire->setBrand( $brand);
        $tire->setCategory($category);
        $tire->setSeason($season);
        $tire->setDesign($design);
        $tire->setSealingMethod($sealing_method);
        $tire->setThorns($thorns);
        $tire->setEnabled(true);
        $tire->setDiscount(0);
        $tire->setRating(4);
        $tire->setQuantity(5);
        $tire->setPrice(115);
        $tire->setLoadIndex(94);
        $tire->setSpeedIndex(210);
        $tire->setDiameter(16);
        $tire->setHeight(55);
        $tire->setWidth(205);
        $tire->setMarketLaunchDate(2020);

        $this->assertEquals('test name', $tire->getName());
        $this->assertEquals($brand, $tire->getBrand());
        $this->assertEquals($category, $tire->getCategory());
        $this->assertEquals($season, $tire->getSeason());
        $this->assertEquals($design, $tire->getDesign());
        $this->assertEquals($sealing_method, $tire->getSealingMethod());
        $this->assertEquals($thorns, $tire->getThorns());
        $this->assertEquals(true, $tire->getEnabled());
        $this->assertEquals(0, $tire->getDiscount());
        $this->assertEquals(4, $tire->getRating());
        $this->assertEquals(5, $tire->getQuantity());
        $this->assertEquals(115, $tire->getPrice());
        $this->assertEquals(94, $tire->getLoadIndex());
        $this->assertEquals(210, $tire->getSpeedIndex());
        $this->assertEquals(16, $tire->getDiameter());
        $this->assertEquals(55, $tire->getHeight());
        $this->assertEquals(205, $tire->getWidth());
        $this->assertEquals(2020, $tire->getMarketLaunchDate());
    }
}