<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Tire\Repository;

use App\Brand\Entity\Brand;
use App\Brand\Repository\BrandRepositoryInterface;
use App\Category\Entity\Category;
use App\Category\Repository\CategoryRepositoryInterface;
use App\DataFixtures\TireFixtures;
use App\Tests\Unit\FixturesTestCase;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;

class TireRepositoryTest extends FixturesTestCase
{
    private TireRepositoryInterface $tireRepository;

    private BrandRepositoryInterface $brandRepository;

    private CategoryRepositoryInterface $categoryRepository;

    protected function setUp()
    {
        parent::setUp();
        $this->tireRepository= $this->em->getRepository(Tire::class);
        $this->brandRepository= $this->em->getRepository(Brand::class);
        $this->categoryRepository= $this->em->getRepository(Category::class);
    }

    public function testCreate()
    {
        $tire = new Tire();
        $brand= new Brand();
        $brand->setName('brand test');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);

        $category = new Category();
        $category->setName('category test');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire->setName('test name');
        $tire->setBrand($brand);
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

        $this->tireRepository->create($tire);

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

    public function testGetProducts()
    {
        $this->assertCount(5, $this->tireRepository->getProducts(true,5));
        $this->assertCount(0, $this->tireRepository->getProducts(true,0));
        $this->assertCount(1, $this->tireRepository->getProducts(false,1));
        $this->assertCount(1, $this->tireRepository->getProducts(false,10));
    }

    public function testFindEnabledById()
    {
        $tire1 = new Tire();
        $brand= new Brand();
        $brand->setName('brand test1');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);

        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1');
        $tire1->setBrand($brand);
        $tire1->setCategory($category);
        $tire1->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire1->setStuds(Tire::STUDS_WITHOUT);
        $tire1->setSeason(Tire::SEASON_MEDIUM);
        $tire1->setEnabled(true);
        $tire1->setDiscount(0);
        $tire1->setRating(4.5);
        $tire1->setQuantity(5);
        $tire1->setPrice(115.5);
        $tire1->setLoadIndex(94);
        $tire1->setSpeedIndex(210);
        $tire1->setDiameter(16);
        $tire1->setHeight(55);
        $tire1->setWidth(205);
        $tire1->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire1);

        $tire2 = new Tire();

        $tire2->setName('test name2');
        $tire2->setBrand($brand);
        $tire2->setCategory($category);
        $tire2->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire2->setStuds(Tire::STUDS_WITHOUT);
        $tire2->setSeason(Tire::SEASON_MEDIUM);
        $tire2->setEnabled(true);
        $tire2->setDiscount(0);
        $tire2->setRating(4.5);
        $tire2->setQuantity(5);
        $tire2->setPrice(115.5);
        $tire2->setLoadIndex(94);
        $tire2->setSpeedIndex(210);
        $tire2->setDiameter(16);
        $tire2->setHeight(55);
        $tire2->setWidth(205);
        $tire2->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire2);

        $this->assertEquals(1, $this->tireRepository->findEnabledById(1)->getId());
        $this->assertEquals(2, $this->tireRepository->findEnabledById(2)->getId());
    }

    public function testGetRelevantByDiameter()
    {
        $arr=[1];
        $this->assertCount(3,$this->tireRepository->getRelevantByDiameter($arr,17,3));
        $this->assertCount(2,$this->tireRepository->getRelevantByDiameter($arr,17,2));
        $this->assertCount(1,$this->tireRepository->getRelevantByDiameter($arr,17,1));

        $this->assertEmpty($this->tireRepository->getRelevantByDiameter($arr,3500,1));

        $this->assertEmpty($this->tireRepository->getRelevantByDiameter($arr,15,1));
        $arr1=[2];
        $this->assertNotEmpty($this->tireRepository->getRelevantByDiameter($arr1,15,1));
    }
}