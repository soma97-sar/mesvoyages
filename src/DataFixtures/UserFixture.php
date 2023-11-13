<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher){
    
            $this->passwordHasher = $passwordHasher; 
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername("admin");
        $plaintextPassword = "admin";
        $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
                
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
