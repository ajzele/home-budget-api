<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\State\ExpenseCategoryProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiProperty;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(processor: ExpenseCategoryProcessor::class)]
class ExpenseCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[ApiProperty(identifier: true)]
    protected ?int $id;

    #[ORM\ManyToOne]
    protected ?User $owner = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    public string $name;

    #[ORM\Column(type: 'datetime')]
    protected \DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    protected \DateTime $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
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
