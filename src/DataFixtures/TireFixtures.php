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
            [$brands[0], $categories[0], Tire::SEASON_MEDIUM, Tire::SEALING_METHOD_TUBE, Tire::STUDS_WITHOUT, 'Hankook test 1', 205, 65, 15, 240, 94, 2012, 94.99, 100, 4.5, 0, true],
            [$brands[1], $categories[1], Tire::SEASON_SNOW, Tire::SEALING_METHOD_TUBELESS, Tire::STUDS_WITH, 'Goodyear test 2', 185, 60, 16, 270, 91, 2020, 115.5, 55, 5.0, 10, true],
            [$brands[2], $categories[2], Tire::SEASON_ALL, Tire::SEALING_METHOD_TUBE, Tire::STUDS_POSSIBILITY, 'Cordiant test 3', 210, 55, 17, 250, 97, 2020, 120, 70, 4.7, 5, true],
            [$brands[2], $categories[0], Tire::SEASON_ALL, Tire::SEALING_METHOD_TUBE, Tire::STUDS_POSSIBILITY, 'Cordiant test 4', 225, 65, 17, 290, 101, 2019, 125, 53, 4.8, 0, true],
            [$brands[5], $categories[0], Tire::SEASON_MEDIUM, Tire::SEALING_METHOD_TUBELESS, Tire::STUDS_WITHOUT, 'Continental test 5', 215, 45, 17, 290, 101, 2018, 125, 53, 4.8, 0, true],
            [$brands[5], $categories[0], Tire::SEASON_MEDIUM, Tire::SEALING_METHOD_TUBELESS, Tire::STUDS_WITHOUT, 'Continental test 6', 255, 40, 18, 300, 101, 2018, 125, 53, 4.8, 0, false],
            [$brands[4], $categories[3], Tire::SEASON_ALL, Tire::SEALING_METHOD_TUBE, Tire::STUDS_WITH, 'Белшина test 7', 300, 80, 25, 200, 150, 2018, 125, 53, 4.8, 0, true],
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