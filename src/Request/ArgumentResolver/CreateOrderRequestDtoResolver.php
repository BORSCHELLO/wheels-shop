<?php

declare(strict_types=1);

namespace App\Request\ArgumentResolver;

use App\Request\Dto\CreateOrderRequestDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateOrderRequestDtoResolver implements ArgumentValueResolverInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getType() === CreateOrderRequestDto::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $dto = new CreateOrderRequestDto();
        $dto->firstName =  $request->get('firstName');
        $dto->lastName = $request->get('lastName');
        $dto->address = $request->get('address');
        $dto->phone = $request->get('phone');
        $dto->noteOfOrder = $request->get('noteOfOrder');
        $dto->postalCode = $request->get('postalCode');
        $dto->paymentMethod = $request->get('paymentMethod');
        $dto->deliveryMethod = $request->get('deliveryMethod');

        $dto->constraintViolations = $this->validator->validate($dto);

        yield $dto;
    }
}