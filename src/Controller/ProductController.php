<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController
{
    private array $products = [[
      'id' => 1,
      'name' => 'Product A',
      'description' => 'Description of Product A',
      'price' => 100.99
  ],
  [
      'id' => 2,
      'name' => 'Product B',
      'description' => 'Description of Product B',
      'price' => 200.49
  ]]; 
    #[Route('/products', name: 'get_products', methods: ['GET'])]
    public function getProducts(): JsonResponse
    {
      $response = new JsonResponse($this->products, 200);
    
      // Add CORS headers
      $response->headers->set('Access-Control-Allow-Origin', '*');
      $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
      $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
      
      return $response;
  
    }

    #[Route('/products/{id}', name: 'get_product_by_id', methods: ['GET'])]
    public function getProductById(int $id): JsonResponse
    {

      if (array_key_exists($id, $this->products)) {
        $response = new JsonResponse($this->products[$id - 1], 200);

        // Add CORS headers
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        
        return $response;
    }

    $response = new JsonResponse(['error' => 'Product not found'], 404);
    
    // Add CORS headers
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    
    return $response;
    }


}
