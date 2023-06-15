<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }
    public function getproductAll()
    {
        return $this->productRepository->getproductAll();
    }
    public function getproductOne($id)
    {
        return $this->productRepository->getproductOne($id);
    }
    public function createproduct($request)
    {
        $user = $request->all();
        return $this->productRepository->createproduct($user);
    }
    public function editproduct($id, $request)
    {
        $user = $request->all();
        return $this->productRepository->editproduct($id, $user);
    }
    public function deleteproduct($id)
    {
        return $this->productRepository->deleteproduct($id);
    }
}
