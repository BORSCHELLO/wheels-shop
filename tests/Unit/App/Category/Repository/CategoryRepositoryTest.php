<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Category\Repository;


use App\Category\Repository\CategoryRepositoryInterface;
use App\Category\Entity\Category;
use App\Tests\Unit\DoctrineTestCase;

class CategoryRepositoryTest extends DoctrineTestCase
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->categoryRepository = $this->em->getRepository(Category::class);

    }

    public function testCreate()
    {
        $category = new Category();
        $category->setName('test');
        $category->setEnabled(true);

        $this->categoryRepository->create($category);

        $this->assertEquals(1, $category->getId());
        $this->assertEquals('test', $category->getName());
        $this->assertEquals(true, $category->getEnabled());
    }

    public function testGetCategorysForFilters()
    {
        $category1 = new Category();

        $category1->setName('name1');
        $category1->setEnabled(true);

        $this->categoryRepository->create($category1);

        $category2 = new Category();

        $category2->setName('name2');
        $category2->setEnabled(false);

        $this->categoryRepository->create($category2);

        $category3 = new Category();

        $category3->setName('name3');
        $category3->setEnabled(true);

        $this->categoryRepository->create($category3);

        $collection = $this->categoryRepository->getCategorysForFilters(true);
        $this->assertCount(2, $collection);
        $this->assertSame($collection->get(0), ['id' => $category1->getId(),'name' => $category1->getName()]);
        $this->assertSame($collection->get(1), ['id' => $category3->getId(),'name' => $category3->getName()]);

        $collection1 = $this->categoryRepository->getCategorysForFilters(false);

        $this->assertCount(1, $collection1);
        $this->assertSame($collection1->get(0), ['id' => $category2->getId(),'name' => $category2->getName()]);
    }
}