<?php

namespace App\Tests\Unit\ApplicationLayer;

use App\Application\Service\UserApplicationService;
use App\Tests\BaseTestCase;
use App\Tests\Factory\UserFactory;
use App\Type\View\UserView;
use Doctrine\ORM\EntityNotFoundException;

class UserApplicationServiceTest extends BaseTestCase
{
  private UserApplicationService $userApplicationService;

  protected function setUp(): void
  {
    parent::setUp();

    $this->userApplicationService = self::getContainer()->get(UserApplicationService::class);
  }

  public function testCannotGetUserWithInvalidId(): void
  {
    $this->expectException(EntityNotFoundException::class);

    $this->userApplicationService->getUser(99999999);
  }

  public function testCanGetUserWithValidId(): void
  {
    $user = UserFactory::createOne();

    $result = $this->userApplicationService->getUser($user->getId());

    $this->assertInstanceOf(UserView::class, $result);
  }
}