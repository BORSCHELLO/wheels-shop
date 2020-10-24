<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Design\Entity;

use App\Design\Entity\Design;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class DesignTest extends TestCase
{
    public function testGetters()
    {
        $design = new Design();

        $helper = new TestPrivateHelper($design);

        $helper->set('id', 1);
        $helper->set('name', 'test name');

        $this->assertEquals(1, $design->getId());
        $this->assertEquals('test name', $design->getName());
    }

    public function testSetters()
    {
        $design = new Design();

        $design->setName('test name');
        $this->assertEquals('test name', $design->getName());
    }
}