<?php

namespace App\Tests;

use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;

class BaseTestCase extends WebTestCase
{

  use Factories;
  protected Generator $faker;

  protected function setUp(): void
  {
    parent::setUp();

      $this->faker = Factory::create('nl_NL');
  }

  protected function tearDown(): void
  {
    
  }
}