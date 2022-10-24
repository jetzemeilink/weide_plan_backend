<?php

namespace App\Tests\Unit\DomainLayer;

use App\Domain\Service\UserDomainService;
use App\Entity\User;
use App\Tests\BaseTestCase;
use App\Tests\Factory\UserFactory;
use App\Type\Request\CreateUserRequest;
use Doctrine\ORM\NonUniqueResultException;

class UserDomainServiceTest extends BaseTestCase
{
  private UserDomainService $userDomainService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->userDomainService = self::getContainer()->get(UserDomainService::class);
  }

  public function testCannotCreateUserWithNonUniqueEmail(): void
  {
    $this->expectException(NonUniqueResultException::class);

    $user = UserFactory::createOne();

    $userRequest = new CreateUserRequest();
    $userRequest->email = $user->getEmail();
    $userRequest->password =  $this->faker->password();

    $this->userDomainService->createUser($userRequest);
  }

  public function testCanCreateUserWithValidInput(): void
  {
    $userRequest = new CreateUserRequest();
    $userRequest->email = $this->faker->email();
    $userRequest->password =  $this->faker->password();

    $user = $this->userDomainService->createUser($userRequest);

    $this->assertInstanceOf(User::class, $user);
    $this->assertNotSame($userRequest->password, $user->getPassword());
  }
}