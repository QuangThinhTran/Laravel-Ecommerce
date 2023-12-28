<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Product;
use App\Repository\Interface\IAttributeRepository;
use App\Repository\Interface\ICommentRepository;
use App\Repository\Interface\IPostRepository;
use App\Repository\Interface\IProductRepository;

class PivotService
{
    protected IPostRepository $postRepository;
    protected IProductRepository $productRepository;
    protected ICommentRepository $commentRepository;
    protected IAttributeRepository $attributeRepository;

    public function __construct
    (
        IPostRepository $postRepository,
        IProductRepository $productRepository,
        ICommentRepository $commentRepository,
        IAttributeRepository $attributeRepository
    ) {
        $this->postRepository = $postRepository;
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function addAttributesProduct($id, array $attributes)
    {
        $product = $this->productRepository->find($id);
        foreach ($attributes as $attribute) {
            $product->attributes()->attach($attribute);
        }
    }

    public function removeAttributesProduct($id, array $attributes)
    {
        $product = $this->productRepository->find($id);
        foreach ($attributes as $attribute) {
            $product->attributes()->detach($attribute);
        }
    }
}