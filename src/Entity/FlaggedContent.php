<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Enum\TargetType;
use App\Entity\Enum\ReasonType;
use App\Entity\Enum\StatusType;
use App\Repository\FlaggedContentRepository;


#[ORM\Entity(repositoryClass: FlaggedContentRepository::class)]
#[ORM\Table(name: 'flagged_content')]
class FlaggedContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $reporter = null;

    #[ORM\Column(enumType: TargetType::class)]
    private TargetType $targetType;

    #[ORM\Column]
    private int $targetId;

    #[ORM\Column(enumType: ReasonType::class)]
    private ReasonType $reason;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(enumType: StatusType::class, options: ['default' => 'pending'])]
    private StatusType $status = StatusType::PENDING;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $reviewedBy = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $reviewedAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /* ================= GETTERS / SETTERS ================= */

    public function getId(): ?int { return $this->id; }

    public function getReporter(): ?User { return $this->reporter; }
    public function setReporter(?User $reporter): static { $this->reporter = $reporter; return $this; }

    public function getTargetType(): TargetType { return $this->targetType; }
    public function setTargetType(TargetType $targetType): static { $this->targetType = $targetType; return $this; }

    public function getTargetId(): int { return $this->targetId; }
    public function setTargetId(int $targetId): static { $this->targetId = $targetId; return $this; }

    public function getReason(): ReasonType { return $this->reason; }
    public function setReason(ReasonType $reason): static { $this->reason = $reason; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): static { $this->description = $description; return $this; }

    public function getStatus(): StatusType { return $this->status; }
    public function setStatus(StatusType $status): static { $this->status = $status; return $this; }

    public function getReviewedBy(): ?User { return $this->reviewedBy; }
    public function setReviewedBy(?User $reviewedBy): static { $this->reviewedBy = $reviewedBy; return $this; }

    public function getReviewedAt(): ?\DateTimeImmutable { return $this->reviewedAt; }
    public function setReviewedAt(?\DateTimeImmutable $reviewedAt): static { $this->reviewedAt = $reviewedAt; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
