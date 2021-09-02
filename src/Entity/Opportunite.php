<?php

namespace App\Entity;

use App\Repository\OpportuniteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OpportuniteRepository::class)
 */
class Opportunite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commercial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $territoire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accord;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etape_transaction;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $confiance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $departement;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_soumission;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_attribution;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $val_total;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $val_nette;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommercial(): ?string
    {
        return $this->commercial;
    }

    public function setCommercial(?string $commercial): self
    {
        $this->commercial = $commercial;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTerritoire(): ?string
    {
        return $this->territoire;
    }

    public function setTerritoire(?string $territoire): self
    {
        $this->territoire = $territoire;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getAccord(): ?string
    {
        return $this->accord;
    }

    public function setAccord(?string $accord): self
    {
        $this->accord = $accord;

        return $this;
    }

    public function getEtape_Transaction(): ?string
    {
        return $this->etape_transaction;
    }

    public function setEtape_Transaction(?string $etape_transaction): self
    {
        $this->etape_transaction = $etape_transaction;

        return $this;
    }

    public function getConfiance(): ?float
    {
        return $this->confiance;
    }

    public function setConfiance(?float $confiance): self
    {
        $this->confiance = $confiance;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getDate_Soumission(): ?\DateTimeInterface
    {
        return $this->date_soumission;
    }

    public function setDate_Soumission(?\DateTimeInterface $date_soumission): self
    {
        $this->date_soumission = $date_soumission;

        return $this;
    }

    public function getDate_Attribution(): ?\DateTimeInterface
    {
        return $this->date_attribution;
    }

    public function setDate_Attribution(?\DateTimeInterface $date_attribution): self
    {
        $this->date_attribution = $date_attribution;

        return $this;
    }

    public function getVal_Total(): ?float
    {
        return $this->val_total;
    }

    public function setVal_Total(?float $val_total): self
    {
        $this->val_total = $val_total;

        return $this;
    }

    public function getVal_Nette(): ?float
    {
        return $this->val_nette;
    }

    public function setVal_Nette(?float $val_nette): self
    {
        $this->val_nette = $val_nette;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
