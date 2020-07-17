<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        for($i=0;$i<5;$i++)
        {
            $category = new Category;
            $category ->setName($faker->realText(10));
            $manager->persist($category);
            $reference = 'category '.$i;
            $this->addReference($reference, $category);
        }
        $manager->flush();
    }
}
