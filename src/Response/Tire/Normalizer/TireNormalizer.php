<?php

declare(strict_types=1);

namespace App\Response\Tire\Normalizer;

use App\Tire\Entity\Tire;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TireNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param Tire $object
     * @param string|null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|string|void|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'images' => $this->normalizer->normalize($object->getImages(), $format, $context),
            'category' => $this->normalizer->normalize($object->getCategory(), $format, $context),
            'brand' => $this->normalizer->normalize($object->getBrand(), $format, $context),
            'season' => $this->normalizer->normalize($object->getSeason(), $format, $context),
            'design' => $this->normalizer->normalize($object->getDesign(), $format, $context),
            'sealingMethod' => $this->normalizer->normalize($object->getSealingMethod(), $format, $context),
            'thorns' => $this->normalizer->normalize($object->getThorns(), $format, $context),
            'width' => $object->getWidth(),
            'height' => $object->getHeight(),
            'diameter' => $object->getDiameter(),
            'speedIndex' => $object->getSpeedIndex(),
            'loadIndex' => $object->getLoadIndex(),
            'marketLaunchDate' => $object->getMarketLaunchDate(),
            'price' => $object->getPrice(),
            'quantity' => $object->getQuantity(),
            'rating' => $object->getRating(),
            'discount' => $object->getDiscount()
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Tire;
    }
}