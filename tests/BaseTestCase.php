<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;

class BaseTestCase extends WebTestCase
{

  use Factories;
  protected Generator $faker;
  private EntityManagerInterface $em;
  protected function setUp(): void
  {
    parent::setUp();

      $this->faker = Factory::create('nl_NL');

      $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
      $this->em->beginTransaction();
  }

  protected function tearDown(): void
{
    $this->em->rollback();
}
}