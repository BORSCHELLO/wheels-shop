<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Tire\Repository;

use App\Brand\Entity\Brand;
use App\Brand\Repository\BrandRepositoryInterface;
use App\Category\Entity\Category;
use App\Category\Repository\CategoryRepositoryInterface;
use App\Design\Entity\Design;
use App\Design\Repository\DesignRepositoryInterface;
use App\Sealing\Entity\Sealing;
use App\Sealing\Repository\SealingRepositoryInterface;
use App\Season\Entity\Season;
use App\Season\Repository\SeasonRepositoryInterface;
use App\Thorns\Entity\Thorns;
use App\Thorns\Repository\ThornsRepositoryInterface;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;

class TireRepositoryTest extends DoctrineTestCase
{
    protected TireRepositoryInterface $tireRepository;

    protected BrandRepositoryInterface $brandRepository;

    protected CategoryRepositoryInterface $categoryRepository;

    protected DesignRepositoryInterface $designRepository;

    protected SeasonRepositoryInterface $seasonRepository;

    protected SealingRepositoryInterface $sealingRepository;

    protected ThornsRepositoryInterface $thornsRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->tireRepository = $this->em->getRepository(Tire::class);
        $this->brandRepository = $this->em->getRepository(Brand::class);
        $this->categoryRepository = $this->em->getRepository(Category::class);
        $this->designRepository = $this->em->getRepository(Design::class);
        $this->seasonRepository = $this->em->getRepository(Season::class);
        $this->sealingRepository = $this->em->getRepository(Sealing::class);
        $this->thornsRepository = $this->em->getRepository(Thorns::class);
    }

    public function testCreate()
    {
        $tire = new Tire();
        $brand = new Brand();
        $brand->setName('brand name');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category name');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);
        $season = new Season();
        $season->setName('season name');
        $this->seasonRepository->create($season);
        $design = new Design();
        $design->setName('design name');
        $this->designRepository->create($design);
        $sealingMethod = new Sealing();
        $sealingMethod->setName('sealing name');
        $this->sealingRepository->create($sealingMethod);
        $this->thornsRepository->create($thorns);

        $tire->setName('test name');
        $tire->setBrand($brand);
        $tire->setCategory($category);
        $tire->setSeason($season);
        $tire->setDesign($design);
        $tire->setSealingMethod($sealingMethod);
        $tire->setStuds($thorns);
        $tire->setEnabled(true);
        $tire->setDiscount(0);
        $tire->setRating(4);
        $tire->setQuantity(5);
        $tire->setPrice(115.6);
        $tire->setLoadIndex(94);
        $tire->setSpeedIndex(210);
        $tire->setDiameter(16);
        $tire->setHeight(55);
        $tire->setWidth(205);
        $tire->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire);

        $this->assertEquals(1, $tire->getId());
        $this->assertEquals('test name', $tire->getName());
        $this->assertEquals('brand name', $tire->getBrand());
        $this->assertEquals('category name', $tire->getCategory());
        $this->assertEquals('season name', $tire->getSeason());
        $this->assertEquals('design name', $tire->getDesign());
        $this->assertEquals($sealingMethod, $tire->getSealingMethod());
        $this->assertEquals('thorns name', $tire->getStuds());
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

    public function testGetProducts()
    {
        $tire1 = new Tire();
        $tire2 = new Tire();
        $tire3 = new Tire();
        $brand = new Brand();
        $brand->setName('brand name');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category name');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);
        $season = new Season();
        $season->setName('season name');
        $this->seasonRepository->create($season);
        $design = new Design();
        $design->setName('design name');
        $this->designRepository->create($design);
        $sealing_method = new Sealing();
        $sealing_method->setName('sealing name');
        $this->sealingRepository->create($sealing_method);
        $thorns = new Thorns();
        $thorns->setName('thorns name');
        $this->thornsRepository->create($thorns);

        $tire1->setName('test name')
        ->setBrand($brand)
        ->setCategory($category)
        ->setSeason($season)
        ->setDesign($design)
        ->setSealingMethod($sealing_method)
        ->setStuds($thorns)
        ->setEnabled(true)
        ->setDiscount(0)
        ->setRating(4)
        ->setQuantity(5)
        ->setPrice(115)
        ->setLoadIndex(94)
        ->setSpeedIndex(210)
        ->setDiameter(16)
        ->setHeight(55)
        ->setWidth(205)
        ->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire1);

        $tire2->setName('test name')
        ->setBrand($brand)
        ->setCategory($category)
        ->setSeason($season)
        ->setDesign($design)
        ->setSealingMethod($sealing_method)
        ->setStuds($thorns)
        ->setEnabled(true)
        ->setDiscount(0)
        ->setRating(4)
        ->setQuantity(5)
        ->setPrice(115)
        ->setLoadIndex(94)
        ->setSpeedIndex(210)
        ->setDiameter(16)
        ->setHeight(55)
        ->setWidth(205)
        ->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire2);

        $tire3->setName('test name')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSeason($season)
            ->setDesign($design)
            ->setSealingMethod($sealing_method)
            ->setStuds($thorns)
            ->setEnabled(false)
            ->setDiscount(0)
            ->setRating(4)
            ->setQuantity(5)
            ->setPrice(115)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);


        $this->tireRepository->create($tire3);

        $collection = $this->tireRepository->getProducts(1);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $tire1);
        $this->assertSame($collection->get(1), $tire2);

        $collection = $this->tireRepository->getProducts(0);

        $this->assertCount(1, $collection);
        $this->assertSame($collection->get(0), $tire3);
    }

    public function testGetProductsById()
    {
        $tire1 = new Tire();
        $tire2 = new Tire();
        $tire3 = new Tire();
        $brand = new Brand();
        $brand->setName('brand name');
        $brand->setEnabled(true);
        $this->brandRepository->create($brand);
        $category = new Category();
        $category->setName('category name');
        $category->setEnabled(true);
        $this->categoryRepository->create($category);
        $season = new Season();
        $season->setName('season name');
        $this->seasonRepository->create($season);
        $design = new Design();
        $design->setName('design name');
        $this->designRepository->create($design);
        $sealing_method = new Sealing();
        $sealing_method->setName('sealing name');
        $this->sealingRepository->create($sealing_method);
        $thorns = new Thorns();
        $thorns->setName('thorns name');
        $this->thornsRepository->create($thorns);

        $tire1->setName('test name')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSeason($season)
            ->setDesign($design)
            ->setSealingMethod($sealing_method)
            ->setStuds($thorns)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4)
            ->setQuantity(5)
            ->setPrice(115)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire1);

        $tire2->setName('test name')
            ->setBrand($brand)
            ->setCategory($category)
            ->setSeason($season)
            ->setDesign($design)
            ->setSealingMethod($sealing_method)
            ->setStuds($thorns)
            ->setEnabled(true)
            ->setDiscount(0)
            ->setRating(4)
            ->setQuantity(5)
            ->setPrice(115)
            ->setLoadIndex(94)
            ->setSpeedIndex(210)
            ->setDiameter(16)
            ->setHeight(55)
            ->setWidth(205)
            ->setMarketLaunchDate(2020);

        $this->tireRepository->create($tire2);


        $collection = $this->tireRepository->getProductsById(1);
        $this->assertCount(1, $collection);
        $this->assertSame($collection->get(0), $tire1);

        $collection = $this->tireRepository->getProducts(5);
        $this->assertEmpty($collection);

    }
}