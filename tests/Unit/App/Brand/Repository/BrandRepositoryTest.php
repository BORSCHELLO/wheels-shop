<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Brand\Repository;


use App\Brand\Entity\Brand;
use App\Brand\Repository\BrandRepositoryInterface;
use App\Category\Entity\Category;
use App\Category\Repository\CategoryRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;
use App\Tests\Unit\TestPrivateHelper;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;

class BrandRepositoryTest extends DoctrineTestCase
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
        $brand = new Brand();
        $brand->setName('test');
        $brand->setEnabled(true);

        $this->brandRepository->create($brand);

        $this->assertEquals(1, $brand->getId());
        $this->assertEquals('test', $brand->getName());
        $this->assertEquals(true, $brand->getEnabled());
    }

    public function testGetBrandsInTires()
    {
        $tire1 = new Tire();
        $brand1= new Brand();
        $brand1->setName('brand test1');
        $brand1->setEnabled(true);
        $this->brandRepository->create($brand1);

        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1');
        $tire1->setBrand($brand1);
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
        $brand2= new Brand();
        $brand2->setName('brand test2');
        $brand2->setEnabled(true);
        $this->brandRepository->create($brand2);

        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2');
        $tire2->setBrand($brand2);
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

        $tire3 = new Tire();
        $brand3= new Brand();
        $brand3->setName('brand test3');
        $brand3->setEnabled(true);
        $this->brandRepository->create($brand3);

        $category = new Category();
        $category->setName('category test3');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire3->setName('test name3');
        $tire3->setBrand($brand3);
        $tire3->setCategory($category);
        $tire3->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire3->setStuds(Tire::STUDS_WITHOUT);
        $tire3->setSeason(Tire::SEASON_MEDIUM);
        $tire3->setEnabled(false);
        $tire3->setDiscount(0);
        $tire3->setRating(4.5);
        $tire3->setQuantity(5);
        $tire3->setPrice(115.5);
        $tire3->setLoadIndex(94);
        $tire3->setSpeedIndex(210);
        $tire3->setDiameter(16);
        $tire3->setHeight(55);
        $tire3->setWidth(205);
        $tire3->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire3);

        $collection = $this->brandRepository->getBrandsInTires(true, 10);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $brand1);
        $this->assertSame($collection->get(1), $brand2);

        $collection1 = $this->brandRepository->getBrandsInTires(false, 10);

        $this->assertCount(1, $collection1);
        $this->assertSame($collection1->get(0), $brand3);

        $collection2 = $this->brandRepository->getBrandsInTires(true, 1);

        $this->assertCount(1, $collection2);
        $this->assertSame($collection2->get(0), $brand1);
    }

    public function testGetBrandsForFilters()
    {
        $tire1 = new Tire();
        $brand1= new Brand();
        $brand1->setName('brand test1');
        $brand1->setEnabled(true);
        $this->brandRepository->create($brand1);

        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire1->setName('test name1');
        $tire1->setBrand($brand1);
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
        $brand2= new Brand();
        $brand2->setName('brand test2');
        $brand2->setEnabled(true);
        $this->brandRepository->create($brand2);

        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2');
        $tire2->setBrand($brand2);
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

        $tire3 = new Tire();
        $brand3= new Brand();
        $brand3->setName('brand test3');
        $brand3->setEnabled(true);
        $this->brandRepository->create($brand3);

        $category = new Category();
        $category->setName('category test3');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire3->setName('test name3');
        $tire3->setBrand($brand3);
        $tire3->setCategory($category);
        $tire3->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire3->setStuds(Tire::STUDS_WITHOUT);
        $tire3->setSeason(Tire::SEASON_MEDIUM);
        $tire3->setEnabled(false);
        $tire3->setDiscount(0);
        $tire3->setRating(4.5);
        $tire3->setQuantity(5);
        $tire3->setPrice(115.5);
        $tire3->setLoadIndex(94);
        $tire3->setSpeedIndex(210);
        $tire3->setDiameter(16);
        $tire3->setHeight(55);
        $tire3->setWidth(205);
        $tire3->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire3);

        $collection = $this->brandRepository->getBrandsForFilters(true);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $brand1);
        $this->assertSame($collection->get(1), $brand2);

        $collection1 = $this->brandRepository->getBrandsForFilters(false);

        $this->assertCount(1, $collection1);
        $this->assertSame($collection1->get(0), $brand3 );
    }
}