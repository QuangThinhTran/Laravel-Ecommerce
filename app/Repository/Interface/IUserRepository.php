<?php
namespace App\Repository\Interface;
interface IUserRepository
{
    public function all();
    public function getUserByAction($action, $data);
    public function getUserByMerchant();
    public function register(array $data);
    public function login(array $data);
    public function find($id);
    public function search();
}