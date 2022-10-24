<?php

namespace App\Application\Service;

use App\Domain\Service\UserDomainService;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Shared\Helpers\Mapper;
use App\Type\Request\CreateUserRequest;
use App\Type\View\UserView;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class UserApplicationService
{
  public function __construct(
    private EntityManagerInterface $em,
    private UserDomainService $userDomainService,
    private UserRepository $userRepository
    )
  {
  }

  public function createUser(CreateUserRequest $createUserRequest): void
  {
    $user = $this->userDomainService->createUser($createUserRequest);

    $this->em->persist($user);
    $this->em->flush();
  }

  public function getUser(int $userId): UserView
  {
    $user = $this->userRepository->find($userId);

    if (!$user instanceof User) {
      throw new EntityNotFoundException('No Entity Found With the provided id');
    }

    return Mapper::mapSingle($user, UserView::class);
  }
}