<?php

namespace App\Entity;

use App\Repository\PrimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrimeRepository::class)
 */
class Prime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PRBrute;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PFA;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $PM;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $APFA;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vex;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPRBrute(): ?float
    {
        return $this->PRBrute;
    }

    public function setPRBrute(?float $PRBrute): self
    {
        $this->PRBrute = $PRBrute;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getPFA(): ?float
    {
        return $this->PFA;
    }

    public function setPFA(?float $PFA): self
    {
        $this->PFA = $PFA;

        return $this;
    }

    public function getPM(): ?float
    {
        return $this->PM;
    }

    public function setPM(?float $PM): self
    {
        $this->PM = $PM;

        return $this;
    }

    public function getAPFA(): ?float
    {
        return $this->APFA;
    }

    public function setAPFA(?float $APFA): self
    {
        $this->APFA = $APFA;

        return $this;
    }

    public function getVex(): ?float
    {
        return $this->vex;
    }

    public function setVex(?float $vex): self
    {
        $this->vex = $vex;

        return $this;
    }
}
