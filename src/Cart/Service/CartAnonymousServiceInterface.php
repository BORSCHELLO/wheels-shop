<?php

declare(strict_types=1);

namespace App\Cart\Service;

use App\Tire\Collection\TireCollection;
use App\Tire\Entity\Tire;

interface CartAnonymousServiceInterface
{
    public function addItems(Tire $tire): void;

    public function getTires(): TireCollection;

    public function deleteItem(int $id): void;

    public function getQuantity(): array;

    public function getTotalPrice(): float;

    public function increment(int $id): int;

    public function decrement(int $id): int;

    public function  getDiscount(): float;

    public function getTotalCost(): float;
}