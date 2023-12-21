<?php
namespace App\Repository\Interface;
interface IUserRepository {
    public function register(array $data);
    public function login(array $data);
}