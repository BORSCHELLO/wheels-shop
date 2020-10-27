<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Season\Entity;

use App\Season\Entity\Season;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class SeasonTest extends TestCase
{
    public function testGetters()
    {
        $season = new Season();

        $helper = new TestPrivateHelper($season);

        $helper->set('id', 1);
        $helper->set('name', 'test name');

        $this->assertEquals(1, $season->getId());
        $this->assertEquals('test name', $season->getName());
    }

    public function testSetters()
    {
        $season = new Season();

        $season->setName('test name');
        $this->assertEquals('test name', $season->getName());
    }
}