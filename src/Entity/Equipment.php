<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $registration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $model;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTime $registrationYear;

    /**
     * @ORM\Column(type="integer")
     */
    private int $buyValue;

    /**
     * @ORM\Column(type="integer")
     */
    private int $lifetime;

    /**
     * @ORM\Column(type="integer")
     */
    private int $workTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $horsepower;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $useCost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $residualValue;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="equipment")
     */
    private User $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistration(): ?string
    {
        return $this->registration;
    }

    public function setRegistration(?string $registration): self
    {
        $this->registration = $registration;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getRegistrationYear(): ?DateTime
    {
        return $this->registrationYear;
    }

    public function setRegistrationYear(?DateTime $registrationYear): self
    {
        $this->registrationYear = $registrationYear;

        return $this;
    }

    public function getBuyValue(): ?int
    {
        return $this->buyValue;
    }

    public function setBuyValue(int $buyValue): self
    {
        $this->buyValue = $buyValue;

        return $this;
    }

    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    public function getWorkTime(): ?int
    {
        return $this->workTime;
    }

    public function setWorkTime(int $workTime): self
    {
        $this->workTime = $workTime;

        return $this;
    }

    public function getHorsepower(): ?int
    {
        return $this->horsepower;
    }

    public function setHorsepower(?int $horsepower): self
    {
        $this->horsepower = $horsepower;

        return $this;
    }

    public function getUseCost(): ?float
    {
        return $this->useCost;
    }

    public function setUseCost(?float $useCost): self
    {
        $this->useCost = $useCost;

        return $this;
    }

    public function getResidualValue(): ?int
    {
        return $this->residualValue;
    }

    public function setResidualValue(int $residualValue): self
    {
        $this->residualValue = $residualValue;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
