<?php

namespace App\DataFixtures;

use App\Factory\RestauranteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        RestauranteFactory::createMany(10);

        $manager->flush();
    }
}
