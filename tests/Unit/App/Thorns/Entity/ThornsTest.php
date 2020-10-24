<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Thorns\Entity;

use App\Thorns\Entity\Thorns;
use App\Tests\Unit\TestPrivateHelper;
use PHPUnit\Framework\TestCase;

class ThornsTest extends TestCase
{
    public function testGetters()
    {
        $thorns = new Thorns();

        $helper = new TestPrivateHelper($thorns);

        $helper->set('id', 1);
        $helper->set('name', 'test name');

        $this->assertEquals(1, $thorns->getId());
        $this->assertEquals('test name', $thorns->getName());
    }

    public function testSetters()
    {
        $thorns = new Thorns();

        $thorns->setName('test name');
        $this->assertEquals('test name', $thorns->getName());
    }
}