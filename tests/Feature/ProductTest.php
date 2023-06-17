<?php

use App\Http\Controllers\ProductController;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetProductAll_Success()
    {
        // Arrange
        $products = ['product1', 'product2'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('getProductAll')
            ->willReturn($products);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->getProductAll();

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($products, $response->getData());
    }

    public function testGetProductAll_Exception()
    {
        // Arrange
        $errorMessage = 'Error message';
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('getProductAll')
            ->willThrowException(new Exception($errorMessage));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->getProductAll();

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Ocorreu um erro ao obter os produtos.',
            'details' => $errorMessage
        ], $response->getData());
    }

    public function testGetProductOne_Success()
    {
        // Arrange
        $id = 1;
        $product = ['id' => 1, 'name' => 'Product 1'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('getProductOne')
            ->with($id)
            ->willReturn($product);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->getProductOne($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($product, $response->getData());
    }

    public function testGetProductOne_Exception()
    {
        // Arrange
        $id = 1;
        $errorMessage = 'Error message';
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('getProductOne')
            ->with($id)
            ->willThrowException(new Exception($errorMessage));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->getProductOne($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Ocorreu um erro ao obter o produto.',
            'details' => $errorMessage
        ], $response->getData());
    }

    public function testGetProductOfBrand_Success()
    {
        // Arrange
        $id = 1;
        $products = ['product1', 'product2'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('getProductOfBrand')
            ->with($id)
            ->willReturn($products);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->getProductOfBrand($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($products, $response->getData());
    }

    public function testGetProductOfBrand_Exception()
    {
        // Arrange
        $id = 1;
        $errorMessage = 'Error message';
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('getProductOfBrand')
            ->with($id)
            ->willThrowException(new Exception($errorMessage));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->getProductOfBrand($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Ocorreu um erro ao obter o produtos.',
            'details' => $errorMessage
        ], $response->getData());
    }

    public function testCreateProduct_Success()
    {
        // Arrange
        $requestData = ['name' => 'Product 1'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('createProduct')
            ->with($requestData)
            ->willReturn(true);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $request = Request::create('/products', 'POST', $requestData);
        $response = $controller->createProduct($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'success' => true,
            'message' => 'Produto criado com sucesso.'
        ], $response->getData());
    }

    public function testCreateProduct_Failure()
    {
        // Arrange
        $requestData = ['name' => 'Product 1'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('createProduct')
            ->with($requestData)
            ->willReturn(false);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $request = Request::create('/products', 'POST', $requestData);
        $response = $controller->createProduct($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Não foi possível criar o produto.'
        ], $response->getData());
    }

    public function testCreateProduct_Exception()
    {
        // Arrange
        $requestData = ['name' => 'Product 1'];
        $errorMessage = 'Error message';
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('createProduct')
            ->with($requestData)
            ->willThrowException(new Exception($errorMessage));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $request = Request::create('/products', 'POST', $requestData);
        $response = $controller->createProduct($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Ocorreu um erro ao criar o produto.',
            'details' => $errorMessage
        ], $response->getData());
    }

    public function testEditProduct_Success()
    {
        // Arrange
        $id = 1;
        $requestData = ['name' => 'Product 1'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('editProduct')
            ->with($id, $requestData)
            ->willReturn(true);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $request = Request::create("/products/{$id}", 'PUT', $requestData);
        $response = $controller->editProduct($id, $request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'success' => true,
            'message' => 'Produto editado com sucesso.'
        ], $response->getData());
    }

    public function testEditProduct_NotFound()
    {
        // Arrange
        $id = 1;
        $requestData = ['name' => 'Product 1'];
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('editProduct')
            ->with($id, $requestData)
            ->willReturn(false);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $request = Request::create("/products/{$id}", 'PUT', $requestData);
        $response = $controller->editProduct($id, $request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Não foi possível encontrar o produto para edição.'
        ], $response->getData());
    }

    public function testEditProduct_Exception()
    {
        // Arrange
        $id = 1;
        $requestData = ['name' => 'Product 1'];
        $errorMessage = 'Error message';
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('editProduct')
            ->with($id, $requestData)
            ->willThrowException(new Exception($errorMessage));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $request = Request::create("/products/{$id}", 'PUT', $requestData);
        $response = $controller->editProduct($id, $request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Ocorreu um erro ao editar o produto.',
            'details' => $errorMessage
        ], $response->getData());
    }

    public function testDeleteProduct_Success()
    {
        // Arrange
        $id = 1;
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('deleteProduct')
            ->with($id)
            ->willReturn(true);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->deleteProduct($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'success' => true,
            'message' => 'Produto deletado com sucesso.'
        ], $response->getData());
    }

    public function testDeleteProduct_NotFound()
    {
        // Arrange
        $id = 1;
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('deleteProduct')
            ->with($id)
            ->willReturn(false);

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->deleteProduct($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Não foi possível encontrar o produto para exclusão.'
        ], $response->getData());
    }

    public function testDeleteProduct_Exception()
    {
        // Arrange
        $id = 1;
        $errorMessage = 'Error message';
        $productServiceMock = $this->createMock(ProductService::class);
        $productServiceMock->expects($this->once())
            ->method('deleteProduct')
            ->with($id)
            ->willThrowException(new Exception($errorMessage));

        $loggerMock = $this->createMock(LoggerInterface::class);
        $controller = new ProductController($productServiceMock, $loggerMock);

        // Act
        $response = $controller->deleteProduct($id);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals([
            'error' => true,
            'message' => 'Ocorreu um erro ao excluir o produto.',
            'details' => $errorMessage
        ], $response->getData());
    }
}
