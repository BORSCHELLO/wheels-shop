<?php

declare(strict_types=1);

namespace App\Order\Entity;

use App\Order\Repository\OrderRepository;
use App\OrderItem\Entity\OrderItem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\User\Entity\User;
use DateTimeImmutable;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 * @ORM\HasLifecycleCallbacks()
 */
class Order
{
    const STATUS_PROCESSING = 'processing';
    const STATUS_APPROVED = 'approved';
    const STATUS_COMPLITED = 'complited';

    const STATUS = [
        self::STATUS_PROCESSING,
        self::STATUS_APPROVED,
        self::STATUS_COMPLITED,
    ];

    const STATUS_LABELS = [
        self::STATUS_PROCESSING => 'Обробатывается',
        self::STATUS_APPROVED => 'Подтвержден',
        self::STATUS_COMPLITED => 'Завершен'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(name="postal_code", type="string", length=15)
     */
    private $postalCode;

    /**
     * @ORM\Column(name="first_name", type="string", length=30)
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=30)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $phone;

    /**
     * @ORM\Column(name="total_cost", type="decimal")
     */
    private $totalCost;

    /**
     * @ORM\Column(name="payment_method", type="string", length=30)
     */
    private $paymentMethod;

    /**
     * @ORM\Column(name="delivery_method", type="string", length=30)
     */
    private $deliveryMethod;

    /**
     * @ORM\Column(name="note_of_order", type="string", length=500, nullable=true)
     */
    private $noteOfOrder;

    /**
     * @ORM\Column(name="created_at", type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(nullable=false, options={"default": Order::STATUS_PROCESSING})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\OrderItem\Entity\OrderItem", mappedBy="order")
     */
    private $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function __toString()
    {
        return $this->getFirstName() . " " . $this->getLastName() . " №" . $this->getId();
    }

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

    public function getTotalCost(): ?float
    {
        return (float) $this->totalCost;
    }

    public function setTotalCost(float $totalCost): self
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getDeliveryMethod(): ?string
    {
        return $this->deliveryMethod;
    }

    public function setDeliveryMethod(string $deliveryMethod): self
    {
        $this->deliveryMethod = $deliveryMethod;

        return $this;
    }

    public function getNoteOfOrder(): ?string
    {
        return $this->noteOfOrder;
    }

    public function setNoteOfOrder(?string $noteOfOrder): self
    {
        $this->noteOfOrder = $noteOfOrder;

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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreatedAt(new DateTimeImmutable());
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        if (!in_array($status, self::STATUS)) {
            throw new InvalidArgumentException();
        }

        $this->status = $status;

        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode): self
    {
        $this->postalCode = $postalCode;

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
}
