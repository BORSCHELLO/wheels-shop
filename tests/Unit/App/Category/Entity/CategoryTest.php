<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Category\Entity;

use App\Category\Entity\Category;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testGetters()
    {
        $category = new Category();

        $helper = new TestPrivateHelper($category);

        $helper->set('id', 1);
        $helper->set('name', 'test name');
        $helper->set('enabled',true);

        $this->assertEquals(1, $category->getId());
        $this->assertEquals('test name', $category->getName());
        $this->assertEquals(true, $category->getEnabled());
    }

    public function testSetters()
    {
        $category = new Category();

        $category->setName('test name');
        $this->assertEquals('test name', $category->getName());

        $category->setEnabled(false);
        $this->assertEquals(false, $category->getEnabled());

    }


}