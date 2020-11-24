<?php

declare(strict_types=1);

namespace App\OrderItem\Entity;

use App\OrderItem\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Order\Entity\Order;
use App\Tire\Entity\Tire;

/**
 * @ORM\Entity(repositoryClass=OrderItemRepository::class)
 * @ORM\Table(name="`order_item`")
 */
class OrderItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity=Tire::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tire;

    /**
     * @ORM\Column(type="integer", length=15)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal")
     */
    private $cost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getTire()
    {
        return $this->tire;
    }

    public function setTire(Tire $tire): self
    {
        $this->tire = $tire;

        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost): self
    {
        $this->cost = $cost;

        return $this;
    }
}