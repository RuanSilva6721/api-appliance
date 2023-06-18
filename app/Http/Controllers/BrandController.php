<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class BrandController extends Controller
{
    private $brandService;
    private $logger;

    public function __construct(BrandService $brandService, LoggerInterface $logger)
    {
        $this->brandService = $brandService;
        $this->logger = $logger;
    }

    public function getBrandAll()
    {
        try {
            return $this->brandService->getBrandAll();
        } catch (\Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter as marcas.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getBrandOne($id)
    {
        try {
            return $this->brandService->getBrandOne($id);
        } catch (\Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter a marca.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function createBrand(Request $request)
    {
        try {
            $result = $this->brandService->createBrand($request);
            if ($result) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Marca criada com sucesso.'
                ], 201);
            } else {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Não foi possível fazer a criação da marca.'
                ], 404);
            }
        } catch (\Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao criar a marca.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function editBrand($id, Request $request)
    {
        try {
            $result = $this->brandService->editBrand($id, $request);
            if ($result) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Marca editada com sucesso.'
                ], 200);
            } else {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Não foi possível encontrar a marca para edição.'
                ], 404);
            }
        } catch (\Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao editar a marca.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteBrand($id)
    {
        try {
            $result = $this->brandService->deleteBrand($id);
            if ($result) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Marca excluída com sucesso.'
                ], 204);
            } else {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Não foi possível encontrar a marca para exclusão.'
                ], 404);
            }
        } catch (\Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao excluir a marca.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    private function logError(\Exception $exception)
    {
        $this->logger->error('Erro no controlador BrandController', [
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
