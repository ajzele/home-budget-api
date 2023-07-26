<?php

// src/Entity/Expense.php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]
class Expense
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
}
