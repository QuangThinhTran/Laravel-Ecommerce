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

    /**
     * Attach Attributes to Product
     * @param $id
     * @param array $attributes
     * @return void
     * */
    public function addAttributesProduct($id, array $attributes): void
    {
        $product = $this->productRepository->find($id);
        foreach ($attributes as $attribute) {
            $product->attributes()->attach($attribute);
        }
    }

    /**
     * Detach Attributes to Product
     * @param $id
     * @param array $attributes
     * @return void
     * */
    public function removeAttributesProduct($id, array $attributes, array $attributesChild): void
    {
        $product = $this->productRepository->find($id);

        foreach ($attributes as $index => $attribute) {
            $attributeChild = $attributesChild[$index] ?? null;

            $product->attributes()->detach($attribute, $attributeChild);
        }
    }

    /**
     * Attach AttributesChild to Product
     * @param $id
     * @param array $attributesChild
     * @return void
     * */
    public function addAttributesChildProduct($id, array $attributesChild):void
    {
        $product = $this->productRepository->find($id);
        foreach ($attributesChild as $attributeChild) {
            $product->attributesChild()->attach($attributeChild);
        }
    }
}