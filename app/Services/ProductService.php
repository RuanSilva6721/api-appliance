<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }
    public function getProductAll()
    {
        return $this->productRepository->getProductAll();
    }
    public function getProductOne($id)
    {
        return $this->productRepository->getProductOne($id);
    }
    public function createProduct($request)
    {
        $user = $request->all();
        return $this->productRepository->createProduct($user);
    }
    public function editProduct($id, $request)
    {
        $user = $request->all();
        return $this->productRepository->editProduct($id, $user);
    }
    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
