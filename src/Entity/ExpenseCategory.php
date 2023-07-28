<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiProperty;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Delete(uriTemplate: 'expense_categories/{id}'),
        new Get(uriTemplate: 'expense_categories/{id}'),
        new Put(uriTemplate: 'expense_categories/{id}'),
        new Patch(uriTemplate: 'expense_categories/{id}'),
        new GetCollection(uriTemplate: 'expense_categories'),
        new Post(uriTemplate: 'expense_categories')
    ],
    normalizationContext: ['groups' => ['output']],
    denormalizationContext: ['groups' => ['input']],
)]
class ExpenseCategory
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

    #[Groups(['can_get_one', 'can_get_all'])]
    public function getOwner(): User
    {
        return $this->owner;
    }

    #[Groups(['can_get_one', 'can_get_all'])]
    public function setOwner(User $owner): self
    {
        $this->owner = $owner;
        return $this;
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
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