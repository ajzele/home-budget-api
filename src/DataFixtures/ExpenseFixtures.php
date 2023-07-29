<?php

namespace App\DataFixtures;

use App\Factory\ExpenseCategoryFactory;
use App\Factory\ExpenseFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = UserFactory::all();

        foreach ($users as $user) {
            $categories = ExpenseCategoryFactory::findBy(['owner' => $user]);

            foreach ($categories as $category) {
                ExpenseFactory::createMany(50,
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
            ExpenseCategoryFixtures::class
        ];
    }
}
