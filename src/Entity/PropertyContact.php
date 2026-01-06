<?php

namespace App\Entity;

use App\Repository\PropertyContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

    enum ContactType: string
    {
        case INFO_REQUEST = 'info_request';
        case VISIT_REQUEST = 'visit_request';
        case PHONE_REQUEST = 'phone_request';
    }

    enum ContactStatus: string
    {
        case NEW = 'new';
        case READ = 'read';
        case RESPONDED = 'responded';
        case ARCHIVED = 'archived';
    }
    
#[ORM\Entity(repositoryClass: PropertyContactRepository::class)]
#[ORM\Table(name: 'property_contacts')]
class PropertyContact
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Property::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Property $property = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $email;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    private string $message;

    #[ORM\Column(enumType: ContactType::class, options: ['default' => 'info_request'])]
    private ContactType $contactType = ContactType::INFO_REQUEST;

    #[ORM\Column(enumType: ContactStatus::class, options: ['default' => 'new'])]
    private ContactStatus $status = ContactStatus::NEW;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $responseNotes = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $respondedBy = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $respondedAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /* ================= GETTERS / SETTERS ================= */

    public function getId(): ?int { return $this->id; }

    public function getProperty(): ?Property { return $this->property; }
    public function setProperty(Property $property): static { $this->property = $property; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): static { $this->user = $user; return $this; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): static { $this->phone = $phone; return $this; }

    public function getMessage(): string { return $this->message; }
    public function setMessage(string $message): static { $this->message = $message; return $this; }

    public function getContactType(): ContactType { return $this->contactType; }
    public function setContactType(ContactType $contactType): static { $this->contactType = $contactType; return $this; }

    public function getStatus(): ContactStatus { return $this->status; }
    public function setStatus(ContactStatus $status): static { $this->status = $status; return $this; }

    public function getResponseNotes(): ?string { return $this->responseNotes; }
    public function setResponseNotes(?string $notes): static { $this->responseNotes = $notes; return $this; }

    public function getRespondedBy(): ?User { return $this->respondedBy; }
    public function setRespondedBy(?User $user): static { $this->respondedBy = $user; return $this; }

    public function getRespondedAt(): ?\DateTimeImmutable { return $this->respondedAt; }
    public function setRespondedAt(?\DateTimeImmutable $datetime): static { $this->respondedAt = $datetime; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
