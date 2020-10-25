<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Brand\Entity\Brand;
use App\Category\Entity\Category;
use App\Tire\Entity\Tire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TireFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $brands = $this->getBrands($manager);
        $categories = $this->getCategories($manager);

        $data = [
            [$brands[0], $categories[0], Tire::SEASON_MEDIUM, Tire::SEALING_METHOD_TUBE, Tire::STUDS_WITHOUT, 'Hankook test 1', 200, 100, 1000, 240, 94, 1912, 94.99, 100, 4.5, 0, true],
            [$brands[1], $categories[1], Tire::SEASON_SNOW, Tire::SEALING_METHOD_TUBELESS, Tire::STUDS_WITH, 'Goodyear test 2', 150, 800, 300, 400, 43, 2020, 500, 1000, 5.0, 10, true],
        ];

        $methods = [
            'brand',
            'category',
            'season',
            'sealingMethod',
            'studs',
            'name',
            'width',
            'height',
            'diameter',
            'speedIndex',
            'loadIndex',
            'marketLaunchDate',
            'price',
            'quantity',
            'rating',
            'discount',
            'enabled',
        ];

        foreach ($data as $tireData) {
            $tire = new Tire();

            foreach ($methods as $index => $method) {
                $method = 'set' . ucfirst($method);
                $tire->$method($tireData[$index]);
            }

            $manager->persist($tire);
        }

        $manager->flush();
    }

    protected function getBrands(ObjectManager $manager): array
    {
        return $manager->getRepository(Brand::class)->findAll();
    }

    protected function getCategories(ObjectManager $manager): array
    {
        return $manager->getRepository(Category::class)->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            BrandFixtures::class,
            CategoryFixtures::class,
        ];
    }
}