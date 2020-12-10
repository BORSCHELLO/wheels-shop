<?php

declare(strict_types=1);

namespace App\Response\Order;

use App\Response\Order\Normalizer\ConstraintViolationsNormalizer;
use App\Response\Serializer\JsonSerializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class OrderValidationJsonResponse extends Response
{
    public function __construct(ConstraintViolationList  $list)
    {
        $normalizers = [
            new ConstraintViolationsNormalizer()
        ];

        $content = (new JsonSerializer($normalizers))->serialize($list);

        parent::__construct($content, Response::HTTP_OK);
    }
}