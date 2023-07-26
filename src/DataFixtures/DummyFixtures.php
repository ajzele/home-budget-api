<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\DummyFactory;

class DummyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DummyFactory::createMany(100);
    }
}
