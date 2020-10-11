<?php

namespace App\Tire\Entity;

use App\Tire\Repository\TireRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Category\Entity\Category;

/**
 * @ORM\Entity(repositoryClass=TireRepository::class)
 */
class Tire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $brand;

    /**
     * @ORM\OneToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $season;

    /**
     * @ORM\Column(type="integer")
     */
    private $width;

    /**
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $diameter;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $design;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $sealing_method;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed_index;

    /**
     * @ORM\Column(type="integer")
     */
    private $load_index;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $thorns;

    /**
     * @ORM\Column(type="integer")
     */
    private $market_launch_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    /**
     * @ORM\Column(type="integer")
     */
    private $discount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getSealingMethod(): ?string
    {
        return $this->sealing_method;
    }

    public function setSealingMethod(string $sealing_method): self
    {
        $this->sealing_method = $sealing_method;

        return $this;
    }

    public function getSpeedIndex(): ?int
    {
        return $this->speed_index;
    }

    public function setSpeedIndex(int $speed_index): self
    {
        $this->speed_index = $speed_index;

        return $this;
    }

    public function getLoadIndex(): ?int
    {
        return $this->load_index;
    }

    public function setLoadIndex(int $load_index): self
    {
        $this->load_index = $load_index;

        return $this;
    }

    public function getThorns(): ?string
    {
        return $this->thorns;
    }

    public function setThorns(string $thorns): self
    {
        $this->thorns = $thorns;

        return $this;
    }

    public function getMarketLaunchDate(): ?int
    {
        return $this->market_launch_date;
    }

    public function setMarketLaunchDate(int $market_launch_date): self
    {
        $this->market_launch_date = $market_launch_date;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
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

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }


    public function getCategory()
    {
        return $this->category;
    }


    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
