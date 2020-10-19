<?php

declare(strict_types=1);

namespace App\Response\Tire\Normalizer;

use App\Category\Entity\Category;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CategoryNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param Category $object
     * @param string|null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|string|void|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'name' => $object->getName()
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Category;
    }
}