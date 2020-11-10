<?php

declare(strict_types=1);

namespace App\Cart\Entity;

use App\Cart\Repository\CartItemRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Tire\Entity\Tire;
use App\User\Entity\User;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=CartItemRepository::class)
 * @Table(name="cart_item", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="user_item",columns={"user_id","tire_id"})
 * })
 */
class CartItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true}))
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Tire::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }


    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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
}
