<?php

namespace App\Entity;

use App\Repository\SavedSearchRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

    enum NotificationFrequency: string
    {
        case DAILY = 'daily';
        case WEEKLY = 'weekly';
        case INSTANT = 'instant';
        case NEVER = 'never';
    }
    
#[ORM\Entity(repositoryClass: SavedSearchRepository::class)]
#[ORM\Table(name: 'saved_searches')]
class SavedSearch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::JSON)]
    private array $filters = [];

    #[ORM\Column(enumType: NotificationFrequency::class, options: ['default' => 'daily'])]
    private NotificationFrequency $notificationFrequency = NotificationFrequency::DAILY;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastNotifiedAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /* ================= GETTERS / SETTERS ================= */

    public function getId(): ?int { return $this->id; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(?User $user): static { $this->user = $user; return $this; }

    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): static { $this->name = $name; return $this; }

    public function getFilters(): array { return $this->filters; }
    public function setFilters(array $filters): static { $this->filters = $filters; return $this; }

    public function getNotificationFrequency(): NotificationFrequency { return $this->notificationFrequency; }
    public function setNotificationFrequency(NotificationFrequency $notificationFrequency): static { $this->notificationFrequency = $notificationFrequency; return $this; }

    public function getLastNotifiedAt(): ?\DateTimeImmutable { return $this->lastNotifiedAt; }
    public function setLastNotifiedAt(?\DateTimeImmutable $lastNotifiedAt): static { $this->lastNotifiedAt = $lastNotifiedAt; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
