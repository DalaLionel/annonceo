<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for($i=0;$i<20;$i++)
        {
        $annonce = new Annonce;
        $annonce 
            ->setTitre('Annonce '.$i)
            ->setDescription($faker->realText())
            ->setPrix($faker->numberBetween(100,100000))
            ->setVille($faker->city())
            ->setCodePostal($faker->numberBetween(10000,99999))
            ->setAdresse($faker->address())
            ->setCreation($faker->dateTimeBetween('-1 month'))
            ;
        $categoryReference = 'category '.$faker->numberBetween(0,4);
        $category = $this->getReference($categoryReference);
        $annonce->setCategory($category);

        $auteurReference = 'user '.$faker->numberBetween(0,9);
        $auteur= $this->getReference($auteurReference);
        $annonce->setAuteur($auteur);

        $manager->persist($annonce);

        $reference = 'annonce '.$i;
        $this->addReference($reference, $annonce);
        }
        $manager->flush();
    }

    /**
     * liste des classes devant être chargées avant les fixtures
     */
    public function getDependencies()
    {
        return [
            CategoryFixtures::class, UserFixtures::class
        ];
    }
}
