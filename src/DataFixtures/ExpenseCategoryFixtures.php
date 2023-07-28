<?php

namespace App\DataFixtures;

use App\Factory\ExpenseCategoryFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExpenseCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = UserFactory::first();

        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Gifts']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Health']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'House']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Pets']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Sports']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Taxi']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Toiletry']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Transport']);
        ExpenseCategoryFactory::createOne(['owner' => $user, 'name' => 'Entertainment']);
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
