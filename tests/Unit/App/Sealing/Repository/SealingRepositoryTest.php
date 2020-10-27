<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Sealing\Repository;


use App\Sealing\Entity\Sealing;
use App\Sealing\Repository\SealingRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;

class SealingRepositoryTest extends DoctrineTestCase
{
    protected SealingRepositoryInterface $sealingRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->sealingRepository = $this->em->getRepository(Sealing::class);

    }

    public function testCreate()
    {
        $sealing = new Sealing();
        $sealing->setName('test');


        $this->sealingRepository->create($sealing);

        $this->assertEquals(1, $sealing->getId());
        $this->assertEquals('test', $sealing->getName());
    }
}