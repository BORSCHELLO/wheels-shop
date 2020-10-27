<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Design\Repository;


use App\Design\Entity\Design;
use App\Design\Repository\DesignRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;

class DesignRepositoryTest extends DoctrineTestCase
{
    protected DesignRepositoryInterface $designRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->designRepository = $this->em->getRepository(Design::class);

    }

    public function testCreate()
    {
        $design = new Design();
        $design->setName('test');


        $this->designRepository->create($design);

        $this->assertEquals(1, $design->getId());
        $this->assertEquals('test', $design->getName());
    }
}