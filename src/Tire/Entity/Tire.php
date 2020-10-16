<?php

namespace App\Tire\Entity;

use App\Tire\Repository\TireRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Category\Entity\Category;
use App\Brand\Entity\Brand;
use App\Season\Entity\Season;
use App\Design\Entity\Design;
use App\Sealing\Entity\Sealing;
use App\Thorns\Entity\Thorns;

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
     * @ORM\ManyToOne(targetEntity=Brand::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Season::class)
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\ManyToOne(targetEntity=Design::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $design;

    /**
     * @ORM\ManyToOne(targetEntity=Sealing::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $sealing_method;

    /**
     * @ORM\Column(name="speed_index", type="integer")
     */
    private $speedIndex;

    /**
     * @ORM\Column(name="load_index", type="integer")
     */
    private $loadIndex;

    /**
     * @ORM\ManyToOne(targetEntity=Thorns::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $thorns;

    /**
     * @ORM\Column(name="market_launch_date", type="integer")
     */
    private $marketLaunchDate;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
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

    public function __toString()
    {
        return $this->brand.' '.$this->getName();
    }
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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(Season $season): self
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

    public function getDesign(): ?Design
    {
        return $this->design;
    }

    public function setDesign(Design $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getSealingMethod(): ?Sealing
    {
        return $this->sealing_method;
    }

    public function setSealingMethod(Sealing $sealing_method): self
    {
        $this->sealing_method = $sealing_method;

        return $this;
    }

    public function getSpeedIndex(): ?int
    {
        return $this->speedIndex;
    }

    public function setSpeedIndex(int $speedIndex): self
    {
        $this->speedIndex = $speedIndex;

        return $this;
    }

    public function getLoadIndex(): ?int
    {
        return $this->loadIndex;
    }

    public function setLoadIndex(int $loadIndex): self
    {
        $this->loadIndex = $loadIndex;

        return $this;
    }

    public function getThorns(): ?Thorns
    {
        return $this->thorns;
    }

    public function setThorns(Thorns $thorns): self
    {
        $this->thorns = $thorns;

        return $this;
    }

    public function getMarketLaunchDate(): ?int
    {
        return $this->marketLaunchDate;
    }

    public function setMarketLaunchDate(int $marketLaunchDate): self
    {
        $this->marketLaunchDate = $marketLaunchDate;

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


    public function getCategory(): ?Category
    {
        return $this->category;
    }


    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

}
