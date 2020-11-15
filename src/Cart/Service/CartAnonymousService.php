<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;
use App\Tire\Repository\TireRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartAnonymousService implements CartAnonymousServiceInterface
{
    private $session;

    private $tireRepository;

    public function __construct(SessionInterface $session, TireRepository $tireRepository)
    {
        $this->session = $session;
        $this->tireRepository = $tireRepository;
    }

    public function addItems(Tire $tire): void
    {
        /*$this->session->clear();*/
        $tires = $this->session->get('tires');
        if($tires){
        $tires = $tires .'-'. $tire->getId();
        }else{
            $tires = $tire->getId();
        }

        $this->session->set('tires', $tires);
    }

    public function getTires(): TireCollection
    {
        $tiresIdStr = (string) $this->session->get('tires');
        if(strpos($tiresIdStr, '-')){
        $tiresId = array_unique(explode('-', $tiresIdStr));
        $tires = $this->tireRepository->getTiresForCartById($tiresId);
        }else{
            $ids[]= (int) $tiresIdStr;
            $tires = $this->tireRepository->getTiresForCartById($ids);
        }

        return $tires;
    }

    public function getQuantity(): array
    {
        $items = explode('-', (string) $this->session->get('tires'));

        return  array_count_values($items);
    }

    public function deleteItem(int $id): void
    {
        $tiresIdStr = (string) $this->session->get('tires');
        $this->session->remove('tires');
        $tiresId = explode('-', $tiresIdStr);
        $result = implode('-',array_diff($tiresId, [$id]));
        $this->session->set('tires',$result);
    }

    public function getTotalPrice(): float
    {
        $tiresIdStr = (string) $this->session->get('tires');
        if($tiresIdStr) {
            $tiresId = array_unique(explode('-', $tiresIdStr));
            $tires = $this->tireRepository->getTiresForCartById($tiresId);
            $items = array_count_values(explode('-', (string)$this->session->get('tires')));
            foreach ($tires as $elem) {
                $totalPrice[] = $elem->getPrice() * $items[$elem->getId()];
            }
            $totalPrice = array_sum($totalPrice);
        }else{
            $totalPrice = 0;
        }

        return $totalPrice;
    }

    public function  getDiscount(): float
    {
        $totalPrice = $this->getTotalPrice();
        if($totalPrice > 400)
        {
            $discount = $totalPrice * 0.05;
        }else{
            $discount = 0;
        }

        return $discount;
    }

    public function increment(int $id): int
    {
        $tires = $this->session->get('tires');
        $this->session->remove('tires');
        $tires = $tires .'-'. $id;
        $this->session->set('tires',$tires);
        $items = array_count_values(explode('-', (string)$this->session->get('tires')));

        return $items[$id];
    }

    public function decrement(int $id): int
    {
        $items = array_count_values(explode('-', (string)$this->session->get('tires')));
        $arrItems = explode('-', (string)$this->session->get('tires'));
        if($items[$id] > 1) {
            $position = array_search($id, $arrItems);
            unset($arrItems[$position]);
        }
        $this->session->remove('tires');
        $tires=implode('-', $arrItems);
        $this->session->set('tires', $tires);
        $items = array_count_values(explode('-', (string)$this->session->get('tires')));

        return $items[$id];
    }

    public function getTotalCost(): float
    {
        $totalCost = $this->getTotalPrice()-$this->getDiscount()+15;

        return $totalCost;
    }
}