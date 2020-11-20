<?php

namespace App\Order\Entity;

use App\Order\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Tire::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tire;

    /**
     * @ORM\Column(type="integer", length=15)
     */
    private $quantity;

    /**
     * @ORM\Column(name="first_name", type="integer", length=15)
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="integer", length=15)
     */
    private $lastName;

    /**
     * @ORM\Column(type="float", length=15)
     */
    private $costItem;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $phone;

    /**
     * @ORM\Column(name="total_cost", type="integer")
     */
    private $totalCost;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $payment_method;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $delivery_method;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $note_of_order;

    /**
     * @ORM\Column(name="created_at", type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTotalCost(): ?int
    {
        return $this->totalCost;
    }

    public function setTotalCost(int $totalCost): self
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): self
    {
        $this->payment_method = $payment_method;

        return $this;
    }

    public function getDeliveryMethod(): ?string
    {
        return $this->delivery_method;
    }

    public function setDeliveryMethod(string $delivery_method): self
    {
        $this->delivery_method = $delivery_method;

        return $this;
    }

    public function getNoteOfOrder(): ?string
    {
        return $this->note_of_order;
    }

    public function setNoteOfOrder(string $note_of_order): self
    {
        $this->note_of_order = $note_of_order;

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

    public function setTire($tire): self
    {
        $this->tire = $tire;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

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

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCostItem()
    {
        return $this->costItem;
    }

    public function setCostItem($costItem): self
    {
        $this->costItem = $costItem;

        return $this;
    }
}
