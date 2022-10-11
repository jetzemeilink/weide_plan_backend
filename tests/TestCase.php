<?php

namespace App\Tests;

use Faker\Factory;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
  protected Generator $faker;

  protected function setUp(): void
  {
      $this->faker = Factory::create('nl_NL');
  }
}