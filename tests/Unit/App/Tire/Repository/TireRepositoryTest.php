<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Tire\Repository;

use App\Brand\Entity\Brand;
use App\Brand\Repository\BrandRepositoryInterface;
use App\Category\Entity\Category;
use App\Category\Repository\CategoryRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;

class TireRepositoryTest extends DoctrineTestCase
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

        $collection = $this->tireRepository->getProducts(true,4);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $tire1);
        $this->assertSame($collection->get(1), $tire2);

        $collection1 = $this->tireRepository->getProducts(false,4);

        $this->assertCount(1, $collection1);
        $this->assertSame($collection1->get(0), $tire3 );

        $collection2 = $this->tireRepository->getProducts(true,1);

        $this->assertCount(1, $collection2);
        $this->assertSame($collection2->get(0), $tire1 );
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

        $tire4 = new Tire();
        $brand4= new Brand();
        $brand4->setName('brand test4');
        $brand4->setEnabled(true);
        $this->brandRepository->create($brand4);

        $category = new Category();
        $category->setName('category test4');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire4->setName('test name4');
        $tire4->setBrand($brand4);
        $tire4->setCategory($category);
        $tire4->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire4->setStuds(Tire::STUDS_WITHOUT);
        $tire4->setSeason(Tire::SEASON_MEDIUM);
        $tire4->setEnabled(true);
        $tire4->setDiscount(0);
        $tire4->setRating(4.5);
        $tire4->setQuantity(5);
        $tire4->setPrice(115.5);
        $tire4->setLoadIndex(94);
        $tire4->setSpeedIndex(210);
        $tire4->setDiameter(15);
        $tire4->setHeight(55);
        $tire4->setWidth(205);
        $tire4->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire4);

        $tire5 = new Tire();
        $brand5= new Brand();
        $brand5->setName('brand test5');
        $brand5->setEnabled(true);
        $this->brandRepository->create($brand5);

        $category = new Category();
        $category->setName('category test5');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire5->setName('test name5');
        $tire5->setBrand($brand5);
        $tire5->setCategory($category);
        $tire5->setSealingMethod(Tire::SEALING_METHOD_TUBELESS);
        $tire5->setStuds(Tire::STUDS_WITHOUT);
        $tire5->setSeason(Tire::SEASON_MEDIUM);
        $tire5->setEnabled(true);
        $tire5->setDiscount(0);
        $tire5->setRating(4.5);
        $tire5->setQuantity(5);
        $tire5->setPrice(115.5);
        $tire5->setLoadIndex(94);
        $tire5->setSpeedIndex(210);
        $tire5->setDiameter(16);
        $tire5->setHeight(55);
        $tire5->setWidth(205);
        $tire5->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire5);

        $collection = $this->tireRepository->getRelevantByDiameter([1], 16, 5);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $tire2);
        $this->assertSame($collection->get(1), $tire5);

        $collection1 = $this->tireRepository->getRelevantByDiameter([1], 16, 1);
        $this->assertCount(1, $collection1);
        $this->assertSame($collection1->get(0), $tire2);
    }

    public function testGetTireForBrandCollection()
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
        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2');
        $tire2->setBrand($brand1);
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

        $category = new Category();
        $category->setName('category test3');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire3->setName('test name3');
        $tire3->setBrand($brand1);
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

        $collection = $this->tireRepository->getTireForBrandCollection( $brand1, 5);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $tire1);
        $this->assertSame($collection->get(1), $tire2);

        $collection2 = $this->tireRepository->getTireForBrandCollection( $brand1, 1);
        $this->assertCount(1, $collection2);
        $this->assertSame($collection2->get(0), $tire1);
    }

    public function testGetPrice()
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
        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2');
        $tire2->setBrand($brand1);
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

        $category = new Category();
        $category->setName('category test3');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire3->setName('test name3');
        $tire3->setBrand($brand1);
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

        $collection = $this->tireRepository->getPrice(true);
        $this->assertCount(2, $collection);
        $this->assertSame($collection[0], ['price' => $tire1->getPrice()]);
        $this->assertSame($collection[1], ['price' => $tire2->getPrice()]);

        $collection2 = $this->tireRepository->getPrice(false);
        $this->assertCount(1, $collection2);
        $this->assertSame($collection2[0], ['price' => $tire3->getPrice()]);
    }

    public function testGetProductsForFilters()
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
        $category = new Category();
        $category->setName('category test1');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire2->setName('test name2');
        $tire2->setBrand($brand1);
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

        $category = new Category();
        $category->setName('category test3');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);

        $tire3->setName('test name3');
        $tire3->setBrand($brand1);
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

        $collection = $this->tireRepository->getProductsForFilters(true);
        $this->assertCount(2, $collection);
        $this->assertSame($collection[0], [
            'width' => $tire1->getWidth(),
            'height' => $tire1->getHeight(),
            'diameter' => $tire1->getDiameter(),
            'speedIndex' => $tire1->getSpeedIndex(),
            'loadIndex' => $tire1->getLoadIndex(),
            'marketLaunchDate' => $tire1->getMarketLaunchDate()
        ]);
        $this->assertSame($collection[1], [
            'width' => $tire2->getWidth(),
            'height' => $tire2->getHeight(),
            'diameter' => $tire2->getDiameter(),
            'speedIndex' => $tire2->getSpeedIndex(),
            'loadIndex' => $tire2->getLoadIndex(),
            'marketLaunchDate' => $tire2->getMarketLaunchDate()
        ]);

        $collection2 = $this->tireRepository->getProductsForFilters(false);
        $this->assertCount(1, $collection2);
        $this->assertSame($collection2[0], [
            'width' => $tire3->getWidth(),
            'height' => $tire3->getHeight(),
            'diameter' => $tire3->getDiameter(),
            'speedIndex' => $tire3->getSpeedIndex(),
            'loadIndex' => $tire3->getLoadIndex(),
            'marketLaunchDate' => $tire3->getMarketLaunchDate()
        ]);
    }
}