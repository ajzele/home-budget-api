<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]
class Income
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private float $amount;

    #[ORM\Column(type: "datetime")]
    private string $date;

    #[ORM\ManyToOne(targetEntity: "Category")]
    #[ORM\JoinColumn(nullable: false)]
    private Category $category;

//    /**
//     * @return int
//     */
//    public function getId(): int
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return float
//     */
//    public function getAmount(): float
//    {
//        return $this->amount;
//    }
//
//    /**
//     * @param float $amount
//     */
//    public function setAmount(float $amount): void
//    {
//        $this->amount = $amount;
//    }
//
//    /**
//     * @return string
//     */
//    public function getDate(): string
//    {
//        return $this->date;
//    }
//
//    /**
//     * @param string $date
//     */
//    public function setDate(string $date): void
//    {
//        $this->date = $date;
//    }
//
//    /**
//     * @return Category
//     */
//    public function getCategory(): Category
//    {
//        return $this->category;
//    }
//
//    /**
//     * @param Category $category
//     */
//    public function setCategory(Category $category): void
//    {
//        $this->category = $category;
//    }
}