<?php

declare(strict_types=1);

namespace App\Response\Order;

use App\Order\Entity\Order;
use App\Response\Order\Normalizer\OrderNormalizer;
use App\Response\Order\Normalizer\UserNormalizer;
use App\Response\Serializer\JsonSerializer;
use Symfony\Component\HttpFoundation\Response;

class OrderJsonResponse extends Response
{
    public function __construct(Order $order)
    {
        $normalizers = [
            new OrderNormalizer(),
            new UserNormalizer()
        ];

        $content = (new JsonSerializer($normalizers))->serialize($order);

        parent::__construct($content, Response::HTTP_OK);
    }
}