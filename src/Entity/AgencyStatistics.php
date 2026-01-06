<?php

namespace App\Entity;

use App\Repository\AgencyStatisticsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgencyStatisticsRepository::class)]
#[ORM\Table(name: 'agency_statistics')]
#[ORM\UniqueConstraint(name: "unique_agency_date", columns: ["agency_id", "date"])]
class AgencyStatistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Agencies::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Agencies $agency = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $date;

    #[ORM\Column(options: ['default' => 0])]
    private int $totalListings = 0;

    #[ORM\Column(options: ['default' => 0])]
    private int $activeListings = 0;

    #[ORM\Column(options: ['default' => 0])]
    private int $totalViews = 0;

    #[ORM\Column(options: ['default' => 0])]
    private int $totalContacts = 0;

    #[ORM\Column(type: Types::DECIMAL, precision: 12, scale: 2, options: ['default' => 0])]
    private float $avgListingPrice = 0.0;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /* ================= GETTERS / SETTERS ================= */

    public function getId(): ?int { return $this->id; }

    public function getAgency(): ?Agencies { return $this->agency; }
    public function setAgency(Agencies $agency): static { $this->agency = $agency; return $this; }

    public function getDate(): \DateTimeImmutable { return $this->date; }
    public function setDate(\DateTimeImmutable $date): static { $this->date = $date; return $this; }

    public function getTotalListings(): int { return $this->totalListings; }
    public function setTotalListings(int $totalListings): static { $this->totalListings = $totalListings; return $this; }

    public function getActiveListings(): int { return $this->activeListings; }
    public function setActiveListings(int $activeListings): static { $this->activeListings = $activeListings; return $this; }

    public function getTotalViews(): int { return $this->totalViews; }
    public function setTotalViews(int $totalViews): static { $this->totalViews = $totalViews; return $this; }

    public function getTotalContacts(): int { return $this->totalContacts; }
    public function setTotalContacts(int $totalContacts): static { $this->totalContacts = $totalContacts; return $this; }

    public function getAvgListingPrice(): float { return $this->avgListingPrice; }
    public function setAvgListingPrice(float $avgListingPrice): static { $this->avgListingPrice = $avgListingPrice; return $this; }

    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
