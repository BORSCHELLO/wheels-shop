<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Brand\Entity\Brand;
use App\Category\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            ['Легковые автомобили', true,],
            ['Внедорожники', true,],
            ['Автобусы и грузовые авто', true,],
            ['Трактора', true,],
            ['Строительная техника', false,],
        ];

        foreach ($data as $categoryData) {
            $category = new Category();
            $category->setName($categoryData[0])
                ->setEnabled($categoryData[1]);

            $manager->persist($category);
        }

        $manager->flush();
    }
}