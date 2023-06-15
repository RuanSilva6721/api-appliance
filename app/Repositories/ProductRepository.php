<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductRepository
{

    public function getproductAll()
    {
        return  DB::transaction(function () {
            return Product::orderBy('name')->get();;
         });
    }
    public function getproductOne($id)
    {
        return  DB::transaction(function () use($id) {
            return Product::find($id);
         });
    }
    public function createproduct($user)
    {
        return  DB::transaction(function () use($user) {
             $product = new Product();
             return $product->create($user);
         });
    }
    public function editproduct($id, $user)
    {
        return  DB::transaction(function () use($id, $user) {
             $product = Product::find($id);
             return $product->update($user);
         });
    }
    public function deleteproduct($id)
    {
        return  DB::transaction(function () use($id) {
            $product = Product::find($id);
            return $product->delete();
        });
    }
}
