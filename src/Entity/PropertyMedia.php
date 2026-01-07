<?php

namespace App\Entity;

use App\Repository\PropertyMediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Enum\MediaType;
    
#[ORM\Entity(repositoryClass: PropertyMediaRepository::class)]
#[ORM\Table(name: 'property_media')]
class PropertyMedia
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Property::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Property $property = null;

    #[ORM\Column(enumType: MediaType::class)]
    private MediaType $mediaType;

    #[ORM\Column(length: 500)]
    private string $url;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $thumbnailUrl = null;

    #[ORM\Column(options: ['default' => 0])]
    private int $position = 0;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caption = null;

    #[ORM\Column(options: ['default' => false])]
    private bool $isMain = false;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $storagePath = null;

    #[ORM\Column(nullable: true)]
    private ?int $fileSize = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $mimeType = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getProperty(): ?Property { return $this->property; }
    public function setProperty(Property $property): static { $this->property = $property; return $this; }

    public function getMediaType(): MediaType { return $this->mediaType; }
    public function setMediaType(MediaType $mediaType): static { $this->mediaType = $mediaType; return $this; }

    public function getUrl(): string { return $this->url; }
    public function setUrl(string $url): static { $this->url = $url; return $this; }

    public function getThumbnailUrl(): ?string { return $this->thumbnailUrl; }
    public function setThumbnailUrl(?string $thumbnailUrl): static { $this->thumbnailUrl = $thumbnailUrl; return $this; }

    public function getPosition(): int { return $this->position; }
    public function setPosition(int $position): static { $this->position = $position; return $this; }

    public function getCaption(): ?string { return $this->caption; }
    public function setCaption(?string $caption): static { $this->caption = $caption; return $this; }

    public function isMain(): bool { return $this->isMain; }
    public function setIsMain(bool $isMain): static { $this->isMain = $isMain; return $this; }

    public function getStoragePath(): ?string { return $this->storagePath; }
    public function setStoragePath(?string $storagePath): static { $this->storagePath = $storagePath; return $this; }

    public function getFileSize(): ?int { return $this->fileSize; }
    public function setFileSize(?int $fileSize): static { $this->fileSize = $fileSize; return $this; }

    public function getMimeType(): ?string { return $this->mimeType; }
    public function setMimeType(?string $mimeType): static { $this->mimeType = $mimeType; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
