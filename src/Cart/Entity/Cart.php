<?php

declare(strict_types=1);

namespace App\Cart\Entity;

use App\Cart\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Tire\Entity\Tire;
use App\User\Entity\User;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $count;

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

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

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
