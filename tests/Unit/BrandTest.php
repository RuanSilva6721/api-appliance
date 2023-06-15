<?php

namespace Tests\Unit;

use App\Http\Controllers\BrandController;
use App\Services\BrandService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Mockery;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockLogger();
    }

    protected function mockLogger()
    {
        $this->app->instance(Logger::class, Mockery::mock(Logger::class));
    }

    public function testGetBrandAll()
    {
        $brands = [
            ['id' => 1, 'name' => 'Brand 1'],
            ['id' => 2, 'name' => 'Brand 2'],
        ];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('getBrandAll')->andReturn($brands);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->getBrandAll();

        $response->assertStatus(200)
            ->assertJson([
                'data' => $brands
            ]);
    }

    public function testGetBrandAllException()
    {
        $errorMessage = 'An error occurred while getting brands.';
        $exception = new \Exception($errorMessage);

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('getBrandAll')->andThrow($exception);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->getBrandAll();

        $response->assertStatus(500)
            ->assertJson([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter as marcas.',
                'details' => $errorMessage,
            ]);
    }

    public function testGetBrandOne()
    {
        $brand = ['id' => 1, 'name' => 'Brand 1'];
        $id = 1;

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('getBrandOne')->with($id)->andReturn($brand);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->getBrandOne($id);

        $response->assertStatus(200)
            ->assertJson([
                'data' => $brand
            ]);
    }

    public function testGetBrandOneException()
    {
        $errorMessage = 'An error occurred while getting the brand.';
        $exception = new \Exception($errorMessage);
        $id = 1;

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('getBrandOne')->with($id)->andThrow($exception);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->getBrandOne($id);

        $response->assertStatus(500)
            ->assertJson([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter a marca.',
                'details' => $errorMessage,
            ]);
    }

    public function testCreateBrandSuccess()
    {
        $requestData = ['name' => 'New Brand'];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('createBrand')->with(Mockery::type(Request::class))->andReturn(true);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->createBrand(new Request($requestData));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Marca criada com sucesso.',
            ]);
    }

    public function testCreateBrandFailure()
    {
        $requestData = ['name' => 'New Brand'];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('createBrand')->with(Mockery::type(Request::class))->andReturn(false);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->createBrand(new Request($requestData));

        $response->assertStatus(404)
            ->assertJson([
                'error' => true,
                'message' => 'Não foi possível fazer a criação da marca.',
            ]);
    }

    public function testCreateBrandException()
    {
        $errorMessage = 'An error occurred while creating the brand.';
        $exception = new \Exception($errorMessage);
        $requestData = ['name' => 'New Brand'];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('createBrand')->with(Mockery::type(Request::class))->andThrow($exception);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->createBrand(new Request($requestData));

        $response->assertStatus(500)
            ->assertJson([
                'error' => true,
                'message' => 'Ocorreu um erro ao criar a marca.',
                'details' => $errorMessage,
            ]);
    }

    public function testEditBrandSuccess()
    {
        $id = 1;
        $requestData = ['name' => 'Updated Brand'];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('editBrand')->with($id, Mockery::type(Request::class))->andReturn(true);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->editBrand($id, new Request($requestData));

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Marca editada com sucesso.',
            ]);
    }

    public function testEditBrandFailure()
    {
        $id = 1;
        $requestData = ['name' => 'Updated Brand'];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('editBrand')->with($id, Mockery::type(Request::class))->andReturn(false);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->editBrand($id, new Request($requestData));

        $response->assertStatus(404)
            ->assertJson([
                'error' => true,
                'message' => 'Não foi possível encontrar a marca para edição.',
            ]);
    }

    public function testEditBrandException()
    {
        $id = 1;
        $errorMessage = 'An error occurred while editing the brand.';
        $exception = new \Exception($errorMessage);
        $requestData = ['name' => 'Updated Brand'];

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('editBrand')->with($id, Mockery::type(Request::class))->andThrow($exception);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->editBrand($id, new Request($requestData));

        $response->assertStatus(500)
            ->assertJson([
                'error' => true,
                'message' => 'Ocorreu um erro ao editar a marca.',
                'details' => $errorMessage,
            ]);
    }

    public function testDeleteBrandSuccess()
    {
        $id = 1;

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('deleteBrand')->with($id)->andReturn(true);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->deleteBrand($id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Marca excluída com sucesso.',
            ]);
    }

    public function testDeleteBrandFailure()
    {
        $id = 1;

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('deleteBrand')->with($id)->andReturn(false);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->deleteBrand($id);

        $response->assertStatus(404)
            ->assertJson([
                'error' => true,
                'message' => 'Não foi possível encontrar a marca para exclusão.',
            ]);
    }

    public function testDeleteBrandException()
    {
        $id = 1;
        $errorMessage = 'An error occurred while deleting the brand.';
        $exception = new \Exception($errorMessage);

        $brandService = Mockery::mock(BrandService::class);
        $brandService->shouldReceive('deleteBrand')->with($id)->andThrow($exception);

        $controller = new BrandController($brandService, app(Logger::class));

        $response = $controller->deleteBrand($id);

        $response->assertStatus(500)
            ->assertJson([
                'error' => true,
                'message' => 'Ocorreu um erro ao excluir a marca.',
                'details' => $errorMessage,
            ]);
    }
}
