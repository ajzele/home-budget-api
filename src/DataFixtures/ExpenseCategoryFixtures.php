<?php

namespace App\DataFixtures;

use App\Factory\ExpenseCategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpenseCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ExpenseCategoryFactory::createMany(10);

        ExpenseCategoryFactory::createOne(['name' => 'Gifts']);
        ExpenseCategoryFactory::createOne(['name' => 'Health']);
        ExpenseCategoryFactory::createOne(['name' => 'House']);
        ExpenseCategoryFactory::createOne(['name' => 'Pets']);
        ExpenseCategoryFactory::createOne(['name' => 'Sports']);
        ExpenseCategoryFactory::createOne(['name' => 'Taxi']);
        ExpenseCategoryFactory::createOne(['name' => 'Toiletry']);
        ExpenseCategoryFactory::createOne(['name' => 'Transport']);
        ExpenseCategoryFactory::createOne(['name' => 'Entertainment']);
    }
}
