<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    public function getProductOfBrand($id)
    {
        return $this->productRepository->getProductOfBrand($id);
    }
    
    public function createProduct($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'voltage' => 'required|max:255',
            'brand_id' => 'numeric',
        ]);
    
        if ($validator->fails()) {
           
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = $request->all();
        return $this->productRepository->createProduct($user);
    }
    public function editProduct($id, $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'voltage' => 'required|max:255',
            'brand_id' => 'numeric',
        ]);
    
        if ($validator->fails()) {
           
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = $request->all();
        return $this->productRepository->editProduct($id, $user);
    }
    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
