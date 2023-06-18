<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_brand_all()
    {
        Brand::factory(10)->create();

        $response = $this->get('/api/applianceBrand');
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'icon',
                'created_at',
                'updated_at'
            ]
        ]);
    
        $responseData = $response->json();
        $this->assertNotEmpty($responseData);

    }

    public function test_get_brand_one()
    {
        $brand = Brand::factory()->create();

        $response = $this->get('/api/applianceBrand/' . $brand->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'icon',
            'created_at',
            'updated_at'
        ]);
    }

    public function test_create_brand()
    {
        $payload = [
            'name' => 'Ruan teste',
            'icon' => 'Icon Teste'
        ];

        $response = $this->post('/api/applianceBrandCreate', $payload);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,
            'message' => 'Marca criada com sucesso.'
        ]);
    }

    public function test_edit_brand()
    {
        $brand = Brand::factory()->create();

        $payload = [
            'name' => 'Ruan teste Upload',
            'icon' => 'Icon Teste'
        ];

        $response = $this->put('/api/applianceBrand/' . $brand->id, $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Marca editada com sucesso.'
        ]);
    }

    public function test_delete_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->delete('/api/applianceBrand/' . $brand->id);

        $response->assertStatus(204);
        $response->assertNoContent();
    }
}
