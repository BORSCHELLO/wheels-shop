<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Brand\Repository;


use App\Brand\Entity\Brand;
use App\Brand\Repository\BrandRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;

class BrandRepositoryTest extends DoctrineTestCase
{
    protected BrandRepositoryInterface $brandRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->brandRepository = $this->em->getRepository(Brand::class);

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

    public function testGetBrand()
    {
        $brand1 = new Brand();

        $brand1->setName('name1');
        $brand1->setEnabled(true);

        $this->brandRepository->create($brand1);

        $brand2 = new Brand();

        $brand2->setName('name2');
        $brand2->setEnabled(false);

        $this->brandRepository->create($brand2);

        $brand3 = new Brand();

        $brand3->setName('name3');
        $brand3->setEnabled(true);

        $this->brandRepository->create($brand3);

        $collection = $this->brandRepository->getBrand(1);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), $brand1);
        $this->assertSame($collection->get(1), $brand3);

        $collection = $this->brandRepository->getBrand(0);

        $this->assertCount(1, $collection);
        $this->assertSame($collection->get(0), $brand2);
    }
}