<?php
namespace App\Services;

use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BrandService
{
    private $brandRepository;

    public function __construct(BrandRepository $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function getBrandAll()
    {
        return $this->brandRepository->getBrandAll();
    }
    public function getBrandOne($id)
    {
        return $this->brandRepository->getBrandOne($id);
    }
    public function createBrand($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
    
        if ($validator->fails()) {
           
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = $request->all();
        return $this->brandRepository->createBrand($user);
    }
    public function editBrand($id, $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
    
        if ($validator->fails()) {
           
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = $request->all();
        return $this->brandRepository->editBrand($id, $user);
    }
    public function deleteBrand($id)
    {
        return $this->brandRepository->deleteBrand($id);
    }
}
