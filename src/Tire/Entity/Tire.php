<?php

declare(strict_types=1);

namespace App\Tire\Entity;

use App\Image\Entity\Image;
use App\Tire\Repository\TireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Category\Entity\Category;
use App\Brand\Entity\Brand;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass=TireRepository::class)
 */
class Tire
{
    const SEALING_METHOD_TUBE = 'tube';
    const SEALING_METHOD_TUBELESS = 'tubeless';

    const SEALING_METHODS = [
        self::SEALING_METHOD_TUBELESS,
        self::SEALING_METHOD_TUBE,
    ];

    const SEALING_METHOD_LABELS = [
        self::SEALING_METHOD_TUBELESS => 'Бескамерная',
        self::SEALING_METHOD_TUBE => 'Камерная',
    ];

    const STUDS_WITH = 'with';
    const STUDS_POSSIBILITY = 'possibility';
    const STUDS_WITHOUT = 'without';

    const STUDS = [
        self::STUDS_WITH,
        self::STUDS_POSSIBILITY,
        self::STUDS_WITHOUT,
    ];

    const STUDS_LABELS = [
        self::STUDS_WITH => 'С шипами',
        self::STUDS_POSSIBILITY => 'С возможностью шиповки',
        self::STUDS_WITHOUT => 'Без шипов',
    ];

    const SEASON_MEDIUM = 'medium';
    const SEASON_SNOW = 'snow';
    const SEASON_ALL = 'all';

    const SEASONS = [
        self::SEASON_MEDIUM,
        self::SEASON_SNOW,
        self::SEASON_ALL,
    ];

    const SEASONS_LABELS = [
        self::SEASON_MEDIUM => 'Летние',
        self::SEASON_SNOW => 'Зимние',
        self::SEASON_ALL => 'Всесезонные',
    ];

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
     * @ORM\Column(nullable=false, options={"default": Tire::SEASON_MEDIUM})
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
     * @ORM\Column(name="sealing_method", nullable=false, options={"default": Tire::SEALING_METHOD_TUBELESS})
     */
    private ?string $sealingMethod;

    /**
     * @ORM\Column(name="speed_index", type="integer")
     */
    private $speedIndex;

    /**
     * @ORM\Column(name="load_index", type="integer")
     */
    private $loadIndex;

    /**
     * @ORM\Column(name="studs", nullable=false, options={"default": Tire::STUDS_WITHOUT})
     */
    private ?string $studs;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Image\Entity\Image", mappedBy="tire")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

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

    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason($season): self
    {
        if (!in_array($season, self::SEASONS)) {
            throw new InvalidArgumentException();
        }

        $this->season = $season;

        return $this;
    }

    public function setDiameter(int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getSealingMethod(): ?string
    {
        return $this->sealingMethod;
    }

    public function setSealingMethod(string $sealingMethod): self
    {
        if (!in_array($sealingMethod, self::SEALING_METHODS)) {
            throw new InvalidArgumentException();
        }

        $this->sealingMethod = $sealingMethod;

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

    public function getStuds(): ?string
    {
        return $this->studs;
    }

    public function setStuds(string $studs): self
    {
        if (!in_array($studs, self::STUDS)) {
            throw new InvalidArgumentException();
        }

        $this->studs = $studs;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
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

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
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
