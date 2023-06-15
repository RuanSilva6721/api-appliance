<?php
namespace App\Services;

use App\Repositories\BrandRepository;

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
        $user = $request->all();
        return $this->brandRepository->createBrand($user);
    }
    public function editBrand($id, $request)
    {
        $user = $request->all();
        return $this->brandRepository->editBrand($id, $user);
    }
    public function deleteBrand($id)
    {
        return $this->brandRepository->deleteBrand($id);
    }
}
