<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Brand\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            ['Hankook', true,],
            ['Goodyear', true,],
            ['Cordiant', true,],
            ['Tigar', true,],
            ['Белшина', false,],
            ['Continental', true,],
            ['Michelin', true,],
        ];

        foreach ($data as $brandData) {
            $brand = new Brand();
            $brand->setName($brandData[0])
                ->setEnabled($brandData[1]);

            $manager->persist($brand);
        }

        $manager->flush();
    }
}