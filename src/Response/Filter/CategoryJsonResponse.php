<?php

declare(strict_types=1);

namespace App\Response\Filter;

use App\Category\Collection\CategoryCollection;
use App\Response\Filter\Normalizer\CategoryNormalizer;
use App\Response\Serializer\JsonSerializer;
use Symfony\Component\HttpFoundation\Response;

class CategoryJsonResponse extends Response
{
    public function __construct(CategoryCollection $collection)
    {
        $normalizers = [
            new CategoryNormalizer()
        ];

        $content = (new JsonSerializer($normalizers))->serialize($collection);

        parent::__construct($content, Response::HTTP_OK);
    }
}