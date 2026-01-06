<?php

namespace App\Entity;

use App\Repository\AgencyAgentRepository;
use Doctrine\ORM\Mapping as ORM;

enum AgencyAgentRole: string
{
    case ADMIN = 'admin';
    case AGENT = 'agent';
    case VIEWER = 'viewer';
}

#[ORM\Entity(repositoryClass: AgencyAgentRepository::class)]
#[ORM\Table(name: 'agency_agents')]
class AgencyAgent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Agencies $agency = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\Column(enumType: AgencyAgentRole::class)]
    private AgencyAgentRole $role = AgencyAgentRole::AGENT;

    #[ORM\Column(options: ['default' => false])]
    private bool $isPrimaryContact = false;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgency(): ?Agencies
    {
        return $this->agency;
    }

    public function setAgency(Agencies $agency): static
    {
        $this->agency = $agency;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getRole(): AgencyAgentRole
    {
        return $this->role;
    }

    public function setRole(AgencyAgentRole $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function isPrimaryContact(): bool
    {
        return $this->isPrimaryContact;
    }

    public function setIsPrimaryContact(bool $isPrimaryContact): static
    {
        $this->isPrimaryContact = $isPrimaryContact;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
