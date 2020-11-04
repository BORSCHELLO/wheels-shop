<?php

declare(strict_types=1);

namespace App\Tire\Service;

use App\Brand\Repository\BrandRepositoryInterface;
use App\Category\Repository\CategoryRepositoryInterface;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;

class FiletrsTireService implements FiltersTireServiceInterface
{
    private TireRepositoryInterface $tireRepository;

    private BrandRepositoryInterface $brandRepository;

    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        TireRepositoryInterface $tireRepository,
        BrandRepositoryInterface $brandRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->tireRepository = $tireRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCollectionFiltersForShop(): array
    {
        $filters = [];

        $category = $this->categoryRepository->getCategorysForFilters(true);
        $brand = $this->brandRepository->getBrandsForFilters(true);

        $seasons = [];
        foreach (Tire::SEASONS_LABELS as $value) {
            $seasons[] = $value;
        }

        $sealingMethod = [];
        foreach (Tire::SEALING_METHOD_LABELS as $value) {
            $sealingMethod[] = $value;
        }

        $studs = [];
        foreach (Tire::STUDS_LABELS as $value) {
            $studs[] = $value;
        }

        $prices = $this->tireRepository->getPrice(true);
        $price = [min($prices), max($prices)];

        $products = $this->tireRepository->getProductsForFilters(true);
        foreach ($products as $product) {
            foreach ($product as $key => $value) {
                switch ($key) {
                    case 'width':
                        $width[] = $value;
                        break;
                    case 'height':
                        $height[] = $value;
                        break;
                    case 'diameter':
                        $diameter[] = $value;
                        break;
                    case 'speedIndex':
                        $speedIndex[] = $value;
                        break;
                    case 'loadIndex':
                        $loadIndex[] = $value;
                        break;
                    case 'marketLaunchDate':
                        $marketLaunchDate[] = $value;
                        break;
                }
            }
        }

        $width = array_unique($width);
        sort($width);

        $height = array_unique($height);
        sort($height);

        $diameter = array_unique($diameter);
        sort($diameter);

        $speedIndex = array_unique($speedIndex);
        sort($speedIndex);

        $loadIndex = array_unique($loadIndex);
        sort($loadIndex);

        $marketLaunchDate = array_unique($marketLaunchDate);
        sort($marketLaunchDate);

        $filters =[$category, $brand, $seasons, $sealingMethod, $studs, $price, $width, $height, $diameter, $speedIndex, $loadIndex, $marketLaunchDate];

        return $filters;
    }

}