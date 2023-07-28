<?php

namespace App\DataFixtures;

use App\Factory\IncomeCategoryFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IncomeCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = UserFactory::first();

        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Gifts']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Health']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'House']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Pets']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Sports']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Taxi']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Toiletry']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Transport']);
        IncomeCategoryFactory::createOne(['owner' => $user, 'name' => 'Entertainment']);
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
