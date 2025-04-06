<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController
{
    private array $products = [
        [
            'id' => 1,
            'name' => 'Item 1',
            'description' => 'Description for item 1',
            'price' => 9.99,
        ],
        [
            'id' => 2,
            'name' => 'Item 2',
            'description' => 'Description for item 2',
            'price' => 19.99,
        ],
        [
            'id' => 3,
            'name' => 'Item 3',
            'description' => 'Description for item 3',
            'price' => 29.99,
        ]
    ]; 
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
      $response = new JsonResponse();
      $response->headers->set('Access-Control-Allow-Origin', '*');
      $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
      $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
      foreach ($this->products as $product) {
          if ($product['id'] === $id) {
              $response = new JsonResponse($product, 200);
              return $response;
          }
      }
      $response = new JsonResponse(['error' => 'Product not found'], 404);
      return $response;
    }


}
