<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

    enum PropertyType: string
    {
        case APARTMENT = 'apartment';
        case HOUSE = 'house';
        case OFFICE = 'office';
        case LAND = 'land';
        case COMMERCIAL = 'commercial';
        case OTHER = 'other';
    }

    enum TransactionType: string
    {
        case SALE = 'sale';
        case RENT = 'rent';
        case SEASONAL_RENT = 'seasonal_rent';
    }

    enum EnergyClass: string
    {
        case A = 'A';
        case B = 'B';
        case C = 'C';
        case D = 'D';
        case E = 'E';
        case F = 'F';
        case G = 'G';
        case H = 'H';
    }

    enum PropertyStatus: string
    {
        case DRAFT = 'draft';
        case PENDING_REVIEW = 'pending_review';
        case PUBLISHED = 'published';
        case SOLD = 'sold';
        case RENTED = 'rented';
        case ARCHIVED = 'archived';
        case REJECTED = 'rejected';
    }

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\Table(name: 'properties')]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)]
    private string $reference;

    #[ORM\ManyToOne(targetEntity: Agencies::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Agencies $agency = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agent = null; 

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\Column(enumType: PropertyType::class)]
    private PropertyType $propertyType;

    #[ORM\Column(enumType: TransactionType::class)]
    private TransactionType $transactionType;

    /* ================= DETAILS ================= */

    #[ORM\Column(nullable: true)]
    private ?int $rooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $bedrooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $bathrooms = null;

    #[ORM\Column(nullable: true)]
    private ?int $toilets = null;

    #[ORM\Column(nullable: true)]
    private ?int $floor = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalFloors = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $livingArea = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $landArea = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $constructionYear = null;

    /* ================= FEATURES ================= */

    #[ORM\Column(options: ['default' => false])]
    private bool $hasElevator = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasParking = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasTerrace = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasBalcony = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasGarden = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasPool = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasCellar = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasAirConditioning = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $hasHeating = false;

    #[ORM\Column(enumType: EnergyClass::class, nullable: true)]
    private ?EnergyClass $energyClass = null;

    #[ORM\Column(enumType: EnergyClass::class, nullable: true)]
    private ?EnergyClass $gesClass = null;

    /* ================= PRICING ================= */

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2)]
    private string $price;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $pricePerSqm = null;

    #[ORM\Column(options: ['default' => false])]
    private bool $feesIncluded = false;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2, nullable: true)]
    private ?string $chargesMonthly = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2, nullable: true)]
    private ?string $propertyTaxYearly = null;

    /* ================= ADDRESS ================= */

    #[ORM\Column(type: Types::TEXT)]
    private string $address;

    #[ORM\Column(length: 100)]
    private string $city;

    #[ORM\Column(length: 10)]
    private string $postalCode;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $department = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 100, options: ['default' => 'France'])]
    private string $country = 'France';

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 11, scale: 8, nullable: true)]
    private ?string $longitude = null;

    /* ================= STATUS ================= */

    #[ORM\Column(enumType: PropertyStatus::class)]
    private PropertyStatus $status = PropertyStatus::DRAFT;

    #[ORM\Column(options: ['default' => false])]
    private bool $isFeatured = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $isUrgent = false;

    #[ORM\Column(options: ['default' => false])]
    private bool $isHighlighted = false;

    /* ================= META ================= */

    #[ORM\Column(options: ['default' => 0])]
    private int $viewCount = 0;

    #[ORM\Column(options: ['default' => 0])]
    private int $contactCount = 0;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $expiresAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    /* ================= LIFECYCLE CALLBACK ================= */

    #[ORM\PreUpdate]
    public function updateTimestamp(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /* ================= MÉTHODES MÉTIER ================= */

    public function markAsPublished(): static
    {
        $this->status = PropertyStatus::PUBLISHED;
        $this->publishedAt = new \DateTimeImmutable();
        return $this;
    }

    public function markAsSold(): static
    {
        $this->status = PropertyStatus::SOLD;
        return $this;
    }

    public function incrementViewCount(): static
    {
        $this->viewCount++;
        return $this;
    }

    public function incrementContactCount(): static
    {
        $this->contactCount++;
        return $this;
    }

    public function isExpired(): bool
    {
        return $this->expiresAt !== null && $this->expiresAt < new \DateTimeImmutable();
    }

    /* ================= GETTERS / SETTERS ================= */

    public function getId(): ?int { return $this->id; }

    public function getReference(): string { return $this->reference; }
    public function setReference(string $reference): static { $this->reference = $reference; return $this; }

    public function getAgency(): ?Agencies { return $this->agency; }
    public function setAgency(Agencies $agency): static { $this->agency = $agency; return $this; }

    public function getAgent(): ?User { return $this->agent; }
    public function setAgent(User $agent): static { $this->agent = $agent; return $this; }

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): static { $this->title = $title; return $this; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): static { $this->description = $description; return $this; }

    public function getPropertyType(): PropertyType { return $this->propertyType; }
    public function setPropertyType(PropertyType $propertyType): static { $this->propertyType = $propertyType; return $this; }

    public function getTransactionType(): TransactionType { return $this->transactionType; }
    public function setTransactionType(TransactionType $transactionType): static { $this->transactionType = $transactionType; return $this; }

    public function getRooms(): ?int { return $this->rooms; }
    public function setRooms(?int $rooms): static { $this->rooms = $rooms; return $this; }

    public function getBedrooms(): ?int { return $this->bedrooms; }
    public function setBedrooms(?int $bedrooms): static { $this->bedrooms = $bedrooms; return $this; }

    public function getBathrooms(): ?int { return $this->bathrooms; }
    public function setBathrooms(?int $bathrooms): static { $this->bathrooms = $bathrooms; return $this; }

    public function getToilets(): ?int { return $this->toilets; }
    public function setToilets(?int $toilets): static { $this->toilets = $toilets; return $this; }

    public function getFloor(): ?int { return $this->floor; }
    public function setFloor(?int $floor): static { $this->floor = $floor; return $this; }

    public function getTotalFloors(): ?int { return $this->totalFloors; }
    public function setTotalFloors(?int $totalFloors): static { $this->totalFloors = $totalFloors; return $this; }

    public function getLivingArea(): ?string { return $this->livingArea; }
    public function setLivingArea(?string $livingArea): static { $this->livingArea = $livingArea; return $this; }

    public function getLandArea(): ?string { return $this->landArea; }
    public function setLandArea(?string $landArea): static { $this->landArea = $landArea; return $this; }

    public function getConstructionYear(): ?int { return $this->constructionYear; }
    public function setConstructionYear(?int $year): static { $this->constructionYear = $year; return $this; }

    public function hasElevator(): bool { return $this->hasElevator; }
    public function setHasElevator(bool $val): static { $this->hasElevator = $val; return $this; }

    public function hasParking(): bool { return $this->hasParking; }
    public function setHasParking(bool $val): static { $this->hasParking = $val; return $this; }

    public function hasTerrace(): bool { return $this->hasTerrace; }
    public function setHasTerrace(bool $val): static { $this->hasTerrace = $val; return $this; }

    public function hasBalcony(): bool { return $this->hasBalcony; }
    public function setHasBalcony(bool $val): static { $this->hasBalcony = $val; return $this; }

    public function hasGarden(): bool { return $this->hasGarden; }
    public function setHasGarden(bool $val): static { $this->hasGarden = $val; return $this; }

    public function hasPool(): bool { return $this->hasPool; }
    public function setHasPool(bool $val): static { $this->hasPool = $val; return $this; }

    public function hasCellar(): bool { return $this->hasCellar; }
    public function setHasCellar(bool $val): static { $this->hasCellar = $val; return $this; }

    public function hasAirConditioning(): bool { return $this->hasAirConditioning; }
    public function setHasAirConditioning(bool $val): static { $this->hasAirConditioning = $val; return $this; }

    public function hasHeating(): bool { return $this->hasHeating; }
    public function setHasHeating(bool $val): static { $this->hasHeating = $val; return $this; }

    public function getEnergyClass(): ?EnergyClass { return $this->energyClass; }
    public function setEnergyClass(?EnergyClass $val): static { $this->energyClass = $val; return $this; }

    public function getGesClass(): ?EnergyClass { return $this->gesClass; }
    public function setGesClass(?EnergyClass $val): static { $this->gesClass = $val; return $this; }

    public function getPrice(): string { return $this->price; }
    public function setPrice(string $price): static { $this->price = $price; return $this; }

    public function getPricePerSqm(): ?string { return $this->pricePerSqm; }
    public function setPricePerSqm(?string $val): static { $this->pricePerSqm = $val; return $this; }

    public function isFeesIncluded(): bool { return $this->feesIncluded; }
    public function setFeesIncluded(bool $val): static { $this->feesIncluded = $val; return $this; }

    public function getChargesMonthly(): ?string { return $this->chargesMonthly; }
    public function setChargesMonthly(?string $val): static { $this->chargesMonthly = $val; return $this; }

    public function getPropertyTaxYearly(): ?string { return $this->propertyTaxYearly; }
    public function setPropertyTaxYearly(?string $val): static { $this->propertyTaxYearly = $val; return $this; }

    public function getAddress(): string { return $this->address; }
    public function setAddress(string $val): static { $this->address = $val; return $this; }

    public function getCity(): string { return $this->city; }
    public function setCity(string $val): static { $this->city = $val; return $this; }

    public function getPostalCode(): string { return $this->postalCode; }
    public function setPostalCode(string $val): static { $this->postalCode = $val; return $this; }

    public function getDepartment(): ?string { return $this->department; }
    public function setDepartment(?string $val): static { $this->department = $val; return $this; }

    public function getRegion(): ?string { return $this->region; }
    public function setRegion(?string $val): static { $this->region = $val; return $this; }

    public function getCountry(): string { return $this->country; }
    public function setCountry(string $val): static { $this->country = $val; return $this; }

    public function getLatitude(): ?string { return $this->latitude; }
    public function setLatitude(?string $val): static { $this->latitude = $val; return $this; }

    public function getLongitude(): ?string { return $this->longitude; }
    public function setLongitude(?string $val): static { $this->longitude = $val; return $this; }

    public function getStatus(): PropertyStatus { return $this->status; }
    public function setStatus(PropertyStatus $val): static { $this->status = $val; return $this; }

    public function isFeatured(): bool { return $this->isFeatured; }
    public function setIsFeatured(bool $val): static { $this->isFeatured = $val; return $this; }

    public function isUrgent(): bool { return $this->isUrgent; }
    public function setIsUrgent(bool $val): static { $this->isUrgent = $val; return $this; }

    public function isHighlighted(): bool { return $this->isHighlighted; }
    public function setIsHighlighted(bool $val): static { $this->isHighlighted = $val; return $this; }

    public function getViewCount(): int { return $this->viewCount; }
    public function setViewCount(int $val): static { $this->viewCount = $val; return $this; }

    public function getContactCount(): int { return $this->contactCount; }
    public function setContactCount(int $val): static { $this->contactCount = $val; return $this; }

    public function getPublishedAt(): ?\DateTimeImmutable { return $this->publishedAt; }
    public function setPublishedAt(?\DateTimeImmutable $val): static { $this->publishedAt = $val; return $this; }

    public function getExpiresAt(): ?\DateTimeImmutable { return $this->expiresAt; }
    public function setExpiresAt(?\DateTimeImmutable $val): static { $this->expiresAt = $val; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function getUpdatedAt(): \DateTimeImmutable { return $this->updatedAt; }
}
