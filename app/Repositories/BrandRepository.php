<?php
namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;


class BrandRepository
{

    public function getBrandAll()
    {
        return  DB::transaction(function () {
            return Brand::orderBy('name')->get();;
         });
    }
    public function getBrandOne($id)
    {
        return  DB::transaction(function () use($id) {
            return Brand::find($id);
         });
    }
    public function createBrand($user)
    {
        return  DB::transaction(function () use($user) {
             $brand = new Brand();
             return $brand->create($user);
         });
    }
    public function editBrand($id, $user)
    {
        return  DB::transaction(function () use($id, $user) {
             $brand = Brand::find($id);
             return $brand->update($user);
         });
    }
    public function deleteBrand($id)
    {
        return  DB::transaction(function () use($id) {
            $brand = Brand::find($id);
            return $brand->delete();
        });
    }
}
