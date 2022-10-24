<?php

namespace App\Domain\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Type\Request\CreateUserRequest;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserDomainService
{

  public function __construct(
    private UserPasswordHasherInterface $passwordHasher,
    private UserRepository $userRepository
    )
  {
  }

  public function createUser(CreateUserRequest $createUserRequest): User
  {
    $existingUser = $this->userRepository->findBy(['email' => $createUserRequest->email]);

    if ($existingUser) {
      throw new NonUniqueResultException();
    }
    
    $user = new User();

    $user->setEmail($createUserRequest->email);
    $user->setRoles([User::ROLE_USER]);

    $hashedPassword = $this->passwordHasher->hashPassword(
      $user,
      $createUserRequest->password
  );

    $user->setPassword($hashedPassword);

    return $user;
  }
}