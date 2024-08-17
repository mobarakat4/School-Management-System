<?php

namespace App\DTO;

class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
