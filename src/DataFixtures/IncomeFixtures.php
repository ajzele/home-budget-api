<?php

namespace App\DataFixtures;

use App\Factory\IncomeCategoryFactory;
use App\Factory\IncomeFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IncomeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = UserFactory::all();

        foreach ($users as $user) {
            $categories = IncomeCategoryFactory::findBy(['owner' => $user]);

            foreach ($categories as $category) {
                IncomeFactory::createMany(10,
                    [
                        'owner' => $user,
                        'category' => $category,
                    ]
                );
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            IncomeCategoryFixtures::class
        ];
    }
}
