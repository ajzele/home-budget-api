<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['output']],
    denormalizationContext: ['groups' => ['input']],
    security: "is_granted('ROLE_USER')",
)]
#[ApiFilter(SearchFilter::class,
    properties: [
        'id' => 'exact',
        'name' => 'partial'
    ])]
#[ApiFilter(DateFilter::class,
    properties: ['createdAt', 'updatedAt'])]
#[ApiFilter(RangeFilter::class,
    properties: ['amount'])]
#[ApiFilter(OrderFilter::class,
    properties: ['id' => 'ASC', 'name' => 'DESC'],
    arguments: ['orderParameterName' => 'order'])]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[ApiProperty(identifier: true)]
    #[Groups(['output'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[Groups(['output'])]
    private ?User $owner = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    #[Groups(['output', 'input'])]
    private string $name;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    #[Groups(['output', 'input'])]
    private float $amount;

    #[ORM\ManyToOne(targetEntity: "IncomeCategory")]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    #[Groups(['output', 'input'])]
    private ?IncomeCategory $category = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['output'])]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['output'])]
    private ?\DateTime $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCategory(): ?IncomeCategory
    {
        return $this->category;
    }

    public function setCategory(IncomeCategory $category): void
    {
        $this->category = $category;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}