<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Services;

class ApiKeyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get API key from environment
        $validApiKey = getenv('API_KEY');
        
        // Get API key from various possible sources
        $requestApiKey = $this->getApiKeyFromRequest($request);

        // If API key is missing or invalid
        if (!$requestApiKey || $requestApiKey !== $validApiKey) {
            // Return error response
            return Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ]);
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }

    private function getApiKeyFromRequest(RequestInterface $request)
    {
        if (!$request instanceof IncomingRequest) {
            return null;
        }

        // Try to get API key from header
        $headerKey = $request->getHeaderLine('X-API-Key');
        if (!empty($headerKey)) {
            return $headerKey;
        }

        // Try to get API key from request parameters
        $apiKey = $request->getServer('HTTP_X_API_KEY');
        if (!empty($apiKey)) {
            return $apiKey;
        }

        // Try to get raw input and parse as JSON
        $rawInput = $request->getBody();
        if (!empty($rawInput)) {
            $jsonData = json_decode($rawInput, true);
            if (is_array($jsonData) && isset($jsonData['api_key'])) {
                return $jsonData['api_key'];
            }
        }

        return null;
    }
} 