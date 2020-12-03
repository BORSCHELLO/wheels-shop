<?php

declare(strict_types=1);

namespace App\Response\Order\Normalizer;

use App\Request\Dto\CreateOrderRequestDto;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ConstraintViolationsNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @param ConstraintViolationList $object
     * @param string|null $format
     * @param array $context
     * @return array|\ArrayObject|bool|float|int|string|void|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        foreach ($object as $error)
        {
            $result[] = ['path' => $error->getPropertyPath(), 'message' => $error->getMessage()];
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof ConstraintViolationListInterface;
    }
}