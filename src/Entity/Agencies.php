<?php

namespace App\Entity;

use App\Repository\AgenciesRepository;
use Doctrine\ORM\Mapping as ORM;

// Enumérations natives PHP 8.1+
enum AgencyVerificationStatus: string
{
    case PENDING = 'pending';
    case VERIFIED = 'verified';
    case REJECTED = 'rejected';
    
    public function label(): string
    {
        return match($this) {
            self::PENDING => 'En attente',
            self::VERIFIED => 'Vérifiée',
            self::REJECTED => 'Rejetée',
        };
    }
}

enum AgencyType: string
{
    case IMMOBILIER = 'immobilier';
    case PROMOTEUR = 'promoteur';
    case BOTH = 'both';
    
    public function label(): string
    {
        return match($this) {
            self::IMMOBILIER => 'Agence immobilière',
            self::PROMOTEUR => 'Promoteur immobilier',
            self::BOTH => 'Agence et promoteur',
        };
    }
}

#[ORM\Entity(repositoryClass: AgenciesRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Agencies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameAr = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $rcNumber = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $iceNumber = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $patentNumber = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $address = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $addressAr = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cityAr = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 100)]
    private ?string $country = 'Maroc';

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $descriptionAr = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $website = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $facebook = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $instagram = null;

    #[ORM\Column(type: 'string', enumType: AgencyVerificationStatus::class)]
    private AgencyVerificationStatus $verificationStatus = AgencyVerificationStatus::PENDING;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $verificationDocument = null;

    #[ORM\Column(type: 'string', enumType: AgencyType::class)]
    private AgencyType $agencyType = AgencyType::IMMOBILIER;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'agencies', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getNameAr(): ?string
    {
        return $this->nameAr;
    }

    public function setNameAr(?string $nameAr): static
    {
        $this->nameAr = $nameAr;
        return $this;
    }

    public function getRcNumber(): ?string
    {
        return $this->rcNumber;
    }

    public function setRcNumber(?string $rcNumber): static
    {
        $this->rcNumber = $rcNumber;
        return $this;
    }

    public function getIceNumber(): ?string
    {
        return $this->iceNumber;
    }

    public function setIceNumber(?string $iceNumber): static
    {
        $this->iceNumber = $iceNumber;
        return $this;
    }

    public function getPatentNumber(): ?string
    {
        return $this->patentNumber;
    }

    public function setPatentNumber(?string $patentNumber): static
    {
        $this->patentNumber = $patentNumber;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;
        return $this;
    }

    public function getAddressAr(): ?string
    {
        return $this->addressAr;
    }

    public function setAddressAr(?string $addressAr): static
    {
        $this->addressAr = $addressAr;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;
        return $this;
    }

    public function getCityAr(): ?string
    {
        return $this->cityAr;
    }

    public function setCityAr(?string $cityAr): static
    {
        $this->cityAr = $cityAr;
        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): static
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDescriptionAr(): ?string
    {
        return $this->descriptionAr;
    }

    public function setDescriptionAr(?string $descriptionAr): static
    {
        $this->descriptionAr = $descriptionAr;
        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;
        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): static
    {
        $this->website = $website;
        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): static
    {
        $this->facebook = $facebook;
        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;
        return $this;
    }

    public function getVerificationStatus(): AgencyVerificationStatus
    {
        return $this->verificationStatus;
    }

    public function setVerificationStatus(AgencyVerificationStatus $verificationStatus): static
    {
        $this->verificationStatus = $verificationStatus;
        return $this;
    }

    public function getVerificationDocument(): ?string
    {
        return $this->verificationDocument;
    }

    public function setVerificationDocument(?string $verificationDocument): static
    {
        $this->verificationDocument = $verificationDocument;
        return $this;
    }

    public function getAgencyType(): AgencyType
    {
        return $this->agencyType;
    }

    public function setAgencyType(AgencyType $agencyType): static
    {
        $this->agencyType = $agencyType;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    // Méthodes utilitaires avec enums
    public function isVerified(): bool
    {
        return $this->verificationStatus === AgencyVerificationStatus::VERIFIED;
    }

    public function isPending(): bool
    {
        return $this->verificationStatus === AgencyVerificationStatus::PENDING;
    }

    public function isRejected(): bool
    {
        return $this->verificationStatus === AgencyVerificationStatus::REJECTED;
    }

    public function isImmobilier(): bool
    {
        return $this->agencyType === AgencyType::IMMOBILIER;
    }

    public function isPromoteur(): bool
    {
        return $this->agencyType === AgencyType::PROMOTEUR;
    }

    public function isBoth(): bool
    {
        return $this->agencyType === AgencyType::BOTH;
    }

    public function getVerificationStatusLabel(): string
    {
        return $this->verificationStatus->label();
    }

    public function getAgencyTypeLabel(): string
    {
        return $this->agencyType->label();
    }

    // Méthodes statiques pour les formulaires
    public static function getVerificationStatusChoices(): array
    {
        return [
            'En attente' => AgencyVerificationStatus::PENDING,
            'Vérifiée' => AgencyVerificationStatus::VERIFIED,
            'Rejetée' => AgencyVerificationStatus::REJECTED,
        ];
    }

    public static function getAgencyTypeChoices(): array
    {
        return [
            'Agence immobilière' => AgencyType::IMMOBILIER,
            'Promoteur immobilier' => AgencyType::PROMOTEUR,
            'Agence et promoteur' => AgencyType::BOTH,
        ];
    }

    // Méthodes de cycle de vie Doctrine
    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    // Méthode magique pour l'affichage
    public function __toString(): string
    {
        return $this->name ?? 'Agence sans nom';
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(User $users): static
    {
        $this->users = $users;

        return $this;
    }
}