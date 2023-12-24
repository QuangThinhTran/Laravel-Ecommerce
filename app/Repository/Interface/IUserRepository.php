<?php
namespace App\Repository\Interface;
interface IUserRepository
{
    public function index();
    public function register(array $data);
    public function login(array $data);
    public function find($id);
    public function search();
}