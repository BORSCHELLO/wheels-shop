<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Thorns\Repository;


use App\Thorns\Entity\Thorns;
use App\Thorns\Repository\ThornsRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;

class ThornsRepositoryTest extends DoctrineTestCase
{
    protected ThornsRepositoryInterface $thornsRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->thornsRepository = $this->em->getRepository(Thorns::class);

    }

    public function testCreate()
    {
        $thorns = new Thorns();
        $thorns->setName('test');


        $this->thornsRepository->create($thorns);

        $this->assertEquals(1, $thorns->getId());
        $this->assertEquals('test', $thorns->getName());
    }
}