<?php

namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use  App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    //Ajout du compte en BDD
    public function addUser(User $user) :bool{
        //Vérifier si le compte existe en BDD
        if($this->userRepository->findOneBy(["email" => $user->getEmail()])) {
            throw new \Exception("Le compte existe déja en BDD");
        }
        try {
           $user->getRoles();
           $user->setPassword($this->hasher->hashPassword($user, $user->getPassword()));
           $this->em->persist($user);
           $this->em->flush();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return true;
    }
}
