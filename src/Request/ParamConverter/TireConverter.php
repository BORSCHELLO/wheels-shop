<?php

declare(strict_types=1);

namespace App\Request\ParamConverter;

use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepositoryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TireConverter implements ParamConverterInterface
{
    private TireRepositoryInterface $tireRepository;

    public function __construct(TireRepositoryInterface $tireRepository)
    {
        $this->tireRepository = $tireRepository;
    }

    /**
     * @inheritDoc
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $tire = $this->tireRepository->findEnabledById((int)$request->get('id'));

        if ($tire === null) {
            throw new NotFoundHttpException('Запрашиваемый товар не найден');
        }

        $request->attributes->set($configuration->getName(), $tire);
    }

    /**
     * @inheritDoc
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === Tire::class;
    }
}