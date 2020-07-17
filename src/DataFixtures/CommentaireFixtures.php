<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        $referenceAuteur= 'user '.$faker->numberBetween(0,9);
        $auteur= $this->getReference($referenceAuteur);
        $referenceAnnonce = 'annonce '.$faker->numberBetween(0,19);
        $annonce = $this->getReference($referenceAnnonce);
        for($i=0;$i<30;$i++)
        {
            $commentaire = new Commentaire;
            $commentaire 
                ->setAuteur($auteur)
                ->setAnnonce($annonce)
                ->setCommentaire($faker->realText(30))
                ->setCreation($faker->dateTimeBetween('-1 month'))
        ;        
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AnnonceFixtures::class, UserFixtures::class
        ];
    }
}
