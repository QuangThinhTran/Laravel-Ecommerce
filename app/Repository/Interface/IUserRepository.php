<?php

namespace App\Repository\Interface;

interface IUserRepository
{
    public function all();

    public function register(array $data);

    public function login(array $data);
}