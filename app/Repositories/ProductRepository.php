<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductRepository
{

    public function getProductAll()
    {
        return  DB::transaction(function () {
            return Product::orderBy('name')->get();;
         });
    }
    public function getProductOne($id)
    {
        return  DB::transaction(function () use($id) {
            return Product::find($id);
         });
    }
    public function createProduct($user)
    {
        return  DB::transaction(function () use($user) {
             $product = new Product();
             return $product->create($user);
         });
    }
    public function editProduct($id, $user)
    {
        return  DB::transaction(function () use($id, $user) {
             $product = Product::find($id);
             return $product->update($user);
         });
    }
    public function deleteProduct($id)
    {
        return  DB::transaction(function () use($id) {
            $product = Product::find($id);
            return $product->delete();
        });
    }
}
