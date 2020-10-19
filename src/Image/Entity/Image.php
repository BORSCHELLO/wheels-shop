<?php

namespace App\Image\Entity;

use App\Image\Repository\ImageRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Tire\Entity\Tire;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tire::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tire;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="image_source", fileNameProperty="source")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __toString()
    {
        return $this->source;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTire(): ?Tire
    {
        return $this->tire;
    }

    public function setTire(?Tire $tire): self
    {
        $this->tire = $tire;

        return $this;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function setSource($source): self
    {
        $this->source = $source;

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

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt( $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(File $source = null)
    {
        $this->imageFile = $source;

        if ($source) {

            $this->setUpdatedAt(new DateTimeImmutable());
        }
    }

    public function getSlug(): string
    {
        return $this->getTire()->getId() .'-'. $this->getName();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
