<?php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;


class ProductRepositoryEloquent implements ProductRepository
{

    public function getProductAll()
    {

        return Product::orderBy('name')->get();;
    }
    public function getProductOne($id)
    {

        return Product::find($id);
    }
    public function getProductOfBrand($id)
    {

        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('brands.id', $id)
        ->select('products.*')
        ->get();

        return $products;

    }
    
    public function createProduct($user)
    {

        $product = new Product();
        return $product->create($user);
    }
    //Se algo de errado no momento de fazer as operações na tabela products automaticamente o laravel faz o rollback e desfaz deixando as informações no banco de dados no formato original.
    public function editProduct($id, $user)
    {
        return  DB::transaction(function () use($id, $user) { 
             $product = Product::find($id);
             return $product->update($user);
         });
    }
    //Se algo de errado no momento de fazer as operações na tabela products automaticamente o laravel faz o rollback e desfaz deixando as informações no banco de dados no formato original.
    public function deleteProduct($id)
    {
        return  DB::transaction(function () use($id) { 
            $product = Product::find($id);
            return $product->delete();
        });
    }
}
