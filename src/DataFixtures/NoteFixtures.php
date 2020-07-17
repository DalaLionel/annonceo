<?php

namespace App\DataFixtures;

use App\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NoteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        $referenceAuteur = 'user '.$faker->numberBetween(0,9);
        $auteur = $this->getReference($referenceAuteur);
        $referenceUtilisateur = 'user '.$faker->numberBetween(0,9);
        $utilisateur = $this->getReference($referenceUtilisateur);
        for ($i=0;$i<10;$i++)
        {
            $note = new Note;
            $note 
                ->setAuteur($auteur)
                ->setUtilisateur($utilisateur)
                ->setNote($faker->numberBetween(1,20))
                ->setCreation($faker->dateTimeBetween('-1 month'))
        ;        
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
             UserFixtures::class
        ];
    }
}
