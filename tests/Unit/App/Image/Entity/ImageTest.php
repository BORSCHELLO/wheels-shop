<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Image\Entity;

use App\Image\Entity\Image;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetters()
    {
        $image = new Image();

        $helper = new TestPrivateHelper($image);

        $helper->set('id', 1);
        $helper->set('source', 'test source');
        $helper->set('name', 'test name');

        $this->assertEquals(1, $image->getId());
        $this->assertEquals('test source', $image->getSource());
        $this->assertEquals('test name', $image->getName());

    }

    public function testSetters()
    {
        $image = new Image();

        $image->setName('test name');
        $image->setSource('test source');

        $this->assertEquals('test name', $image->getName());
        $this->assertEquals('test source', $image->getSource());
    }

}