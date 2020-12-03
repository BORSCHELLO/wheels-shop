<?php

declare(strict_types=1);

namespace App\Response\Order\Normalizer;


use App\Order\Entity\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OrderNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param Order $object
     * @param string|null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|string|void|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        $result = [
            'id' => $object->getId(),
            'price' => $object->getTotalCost(),
            'user' => $this->normalizer->normalize($object->getUser(), $format, $context),
        ];

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Order;
    }
}