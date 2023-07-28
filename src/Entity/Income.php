<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    public string $name;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private float $amount;

    #[ORM\ManyToOne(targetEntity: "IncomeCategory")]
    #[ORM\JoinColumn(nullable: false)]
    private IncomeCategory $category;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return IncomeCategory
     */
    public function getCategory(): IncomeCategory
    {
        return $this->category;
    }

    /**
     * @param IncomeCategory $category
     */
    public function setCategory(IncomeCategory $category): void
    {
        $this->category = $category;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = new \DateTime('now');

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = new \DateTime('now');

        return $this;
    }
}