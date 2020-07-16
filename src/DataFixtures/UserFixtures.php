<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**@var UserPasswordEncoderInterface*/
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for($i=0;$i<10;$i++)
        {
            $user = new User;
            $hash = $this->passwordEncoder->encodePassword($user, 'user'.$i);
            $user 
             ->setEmail('user'.$i.'@mail.user')
             ->setPassword($hash)
             ->setPseudo($faker->userName())
             ->setPrenom($faker->firstName())
             ->setNom($faker->name())
             ->setTelephone($faker->phoneNumber())
             ->setInscription($faker->dateTimeBetween('-1 month'));
            $manager->persist($user);
        }
        
        for($i=0;$i<2;$i++)
        {
            $admin = new User;
            $hash = $this->passwordEncoder->encodePassword($admin, 'admin'.$i);
            $admin
             ->setEmail('admin'.$i.'mail.admin')
             ->setRoles(['ROLE_ADMIN'])
             ->setPassword($hash)
             ->setPseudo($faker->userName())
             ->setPrenom($faker->firstName())
             ->setNom($faker->name())
             ->setTelephone($faker->phoneNumber())
             ->setInscription($faker->dateTimeBetween('-1 month'));
             $manager->persist($admin);
        }

        for($i=0;$i<5;$i++)
        {
            $modo  = new User;
            $hash = $this->passwordEncoder->encodePassword($modo, 'modo'.$i);
            $modo
             ->setRoles(['ROLE_MODO'])
             ->setEmail('modo'.$i.'@mail.modo')
             ->setPassword($hash)
             ->setPseudo($faker->userName())
             ->setPrenom($faker->firstName())
             ->setNom($faker->name())
             ->setTelephone($faker->phoneNumber())
             ->setInscription($faker->dateTimeBetween('-1 month'));
             $manager->persist($modo);

        }


        $manager->flush();
    }
}
