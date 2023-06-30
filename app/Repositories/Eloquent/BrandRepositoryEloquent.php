<?php
namespace App\Repositories\Eloquent;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Support\Facades\DB;


class BrandRepositoryEloquent implements BrandRepository
{

    public function getBrandAll()
    {

        return Brand::orderBy('name')->get();;
    }
    public function getBrandOne($id)
    {
        return Brand::find($id);

    }
    public function createBrand($user)
    {
        $brand = new Brand();
        return $brand->create($user);
    }
    //Se algo de errado no momento de fazer as operações na tabela brand automaticamente o laravel faz o rollback e desfaz deixando as informações no banco de dados no formato original.
    public function editBrand($id, $user)
    {
        return  DB::transaction(function () use($id, $user) { 
             $brand = Brand::find($id);
             return $brand->update($user);
         });
    }
    //Se algo de errado no momento de fazer as operações na tabela brand automaticamente o laravel faz o rollback e desfaz deixando as informações no banco de dados no formato original.
    public function deleteBrand($id)
    {
        return  DB::transaction(function () use($id) { 
            $brand = Brand::find($id);
            return $brand->delete();
        });
    }
}
