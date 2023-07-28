<?php

namespace App\DataFixtures;

use App\Factory\IncomeCategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IncomeCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // IncomeCategoryFactory::createMany(10);

        IncomeCategoryFactory::createOne(['name' => 'Deposits']);
        IncomeCategoryFactory::createOne(['name' => 'Salary']);
        IncomeCategoryFactory::createOne(['name' => 'Savings']);
    }
}
