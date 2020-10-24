<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Sealing\Entity;

use App\Sealing\Entity\Sealing;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class SealingTest extends TestCase
{
    public function testGetters()
    {
        $sealing = new Sealing();

        $helper = new TestPrivateHelper($sealing);

        $helper->set('id', 1);
        $helper->set('name', 'test name');

        $this->assertEquals(1, $sealing->getId());
        $this->assertEquals('test name', $sealing->getName());
    }

    public function testSetters()
    {
        $sealing = new Sealing();

        $sealing->setName('test name');
        $this->assertEquals('test name', $sealing->getName());
    }
}