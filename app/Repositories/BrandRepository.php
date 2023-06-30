<?php
namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;


interface BrandRepository
{

    public function getBrandAll();
    public function getBrandOne($id);
    public function createBrand($user);
    public function editBrand($id, $user);
    public function deleteBrand($id);
}
