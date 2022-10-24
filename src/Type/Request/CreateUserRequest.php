<?php

namespace App\Type\Request;

class CreateUserRequest
{
  public ?string $email = null;
  public ?string $password = null;
}