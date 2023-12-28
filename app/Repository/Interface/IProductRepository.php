<?php
namespace App\Repository\Interface;

interface IProductRepository
{
    public function index();
    public function getProductByActive($active);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function restore($id);
}