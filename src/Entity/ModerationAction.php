<?php

namespace App\Entity;

use App\Repository\ModerationActionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Enum\TargetType;


    enum ActionType: string
    {
        case APPROVE = 'approve';
        case REJECT = 'reject';
        case SUSPEND = 'suspend';
        case EDIT = 'edit';
        case DELETE = 'delete';
    }
    
#[ORM\Entity(repositoryClass: ModerationActionRepository::class)]
#[ORM\Table(name: 'moderation_actions')]
class ModerationAction
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $moderator = null;

    #[ORM\Column(enumType: TargetType::class)]
    private TargetType $targetType;

    #[ORM\Column]
    private int $targetId;

    #[ORM\Column(enumType: ActionType::class)]
    private ActionType $action;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /* ================= GETTERS / SETTERS ================= */

    public function getId(): ?int { return $this->id; }

    public function getModerator(): ?User { return $this->moderator; }
    public function setModerator(User $moderator): static { $this->moderator = $moderator; return $this; }

    public function getTargetType(): TargetType { return $this->targetType; }
    public function setTargetType(TargetType $targetType): static { $this->targetType = $targetType; return $this; }

    public function getTargetId(): int { return $this->targetId; }
    public function setTargetId(int $targetId): static { $this->targetId = $targetId; return $this; }

    public function getAction(): ActionType { return $this->action; }
    public function setAction(ActionType $action): static { $this->action = $action; return $this; }

    public function getReason(): ?string { return $this->reason; }
    public function setReason(?string $reason): static { $this->reason = $reason; return $this; }

    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(?string $notes): static { $this->notes = $notes; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
