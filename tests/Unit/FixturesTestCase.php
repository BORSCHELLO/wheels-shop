<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DataFixtures\BrandFixtures;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;

class FixturesTestCase extends DoctrineTestCase
{
    protected EntityManager $em;

    protected function setUp()
    {
        parent::setUp();

        $loader = new Loader();
        $loader->addFixture(new BrandFixtures());
        $loader->addFixture(new CategoryFixtures());

        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());
    }
}
