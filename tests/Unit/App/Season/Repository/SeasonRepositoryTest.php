<?php

declare(strict_types=1);

namespace App\Tests\Unit\App\Season\Repository;


use App\Season\Entity\Season;
use App\Season\Repository\SeasonRepositoryInterface;
use App\Tests\Unit\DoctrineTestCase;

class SeasonRepositoryTest extends DoctrineTestCase
{
    protected SeasonRepositoryInterface $seasonRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->seasonRepository = $this->em->getRepository(Season::class);

    }

    public function testCreate()
    {
        $season = new Season();
        $season->setName('test');


        $this->seasonRepository->create($season);

        $this->assertEquals(1, $season->getId());
        $this->assertEquals('test', $season->getName());
    }
}