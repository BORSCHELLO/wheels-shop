<?php

declare(strict_types=1);

namespace App\Response\Tire;

use App\Response\Tire\Normalizer\BrandNormalizer;
use App\Response\Tire\Normalizer\CategoryNormalizer;
use App\Response\Tire\Normalizer\DesignNormalizer;
use App\Response\Tire\Normalizer\ImageNormalizer;
use App\Response\Tire\Normalizer\SealingMethodNormalizer;
use App\Response\Tire\Normalizer\SeasonNormalizer;
use App\Response\Tire\Normalizer\ThornsNormalizer;
use App\Tire\Collection\TireCollection;
use App\Response\Tire\Normalizer\TireNormalizer;
use App\Response\Serializer\JsonSerializer;
use Symfony\Component\HttpFoundation\Response;

class TireJsonResponse extends Response
{
    public function __construct(TireCollection $collection)
    {
        $normalizers = [
            new CategoryNormalizer(),
            new BrandNormalizer(),
            new SeasonNormalizer(),
            new DesignNormalizer(),
            new SealingMethodNormalizer(),
            new ThornsNormalizer(),
            new ImageNormalizer(),
            new TireNormalizer()
        ];

        $content = (new JsonSerializer($normalizers))->serialize($collection);

        parent::__construct($content, Response::HTTP_OK);
    }
}