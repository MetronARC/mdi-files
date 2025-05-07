<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CloudflareApiFilter implements FilterInterface
{
    private $cloudflareEmail;
    private $cloudflareApiKey;
    private $cloudflareZoneId;

    public function __construct()
    {
        $this->cloudflareEmail = getenv('CLOUDFLARE_EMAIL');
        $this->cloudflareApiKey = getenv('CLOUDFLARE_API_KEY');
        $this->cloudflareZoneId = getenv('CLOUDFLARE_ZONE_ID');
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the environment
        $environment = ENVIRONMENT;

        // Skip checks in development environment
        if ($environment === 'development') {
            return;
        }

        // Verify Cloudflare headers
        $cfRay = $request->getHeaderLine('CF-RAY');
        $cfConnectingIP = $request->getHeaderLine('CF-Connecting-IP');
        $cfVisitor = $request->getHeaderLine('CF-Visitor');
        $cfIPCountry = $request->getHeaderLine('CF-IPCountry');

        // Check if request is coming through Cloudflare
        if (!$cfRay || !$cfConnectingIP) {
            return $this->failedResponse('Request must come through Cloudflare', 403);
        }

        // Verify the request is using HTTPS (through Cloudflare)
        $cfVisitorData = json_decode($cfVisitor, true);
        if (!$cfVisitorData || $cfVisitorData['scheme'] !== 'https') {
            return $this->failedResponse('HTTPS is required', 403);
        }

        // Verify API key from request
        $requestApiKey = $request->getHeaderLine('X-API-Key');
        if (!$requestApiKey || !$this->verifyApiKey($requestApiKey)) {
            return $this->failedResponse('Invalid API key', 401);
        }

        // Optional: Verify Cloudflare IP
        if (!$this->isCloudflareIP($request->getIPAddress())) {
            return $this->failedResponse('Invalid request origin', 403);
        }

        // Optional: Rate limiting based on CF-IPCountry
        if ($cfIPCountry) {
            // You can implement country-based rate limiting here
        }

        // Verify the domain through Cloudflare API
        if (!$this->verifyDomain()) {
            return $this->failedResponse('Invalid domain configuration', 403);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Add security headers
        $response->setHeader('X-Content-Type-Options', 'nosniff')
                ->setHeader('X-Frame-Options', 'SAMEORIGIN')
                ->setHeader('X-XSS-Protection', '1; mode=block');
    }

    private function verifyApiKey($requestApiKey)
    {
        // Implement secure comparison
        return hash_equals($this->cloudflareApiKey, $requestApiKey);
    }

    private function verifyDomain()
    {
        // Skip verification in development
        if (ENVIRONMENT === 'development') {
            return true;
        }

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones/" . $this->cloudflareZoneId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "X-Auth-Email: " . $this->cloudflareEmail,
                "X-Auth-Key: " . $this->cloudflareApiKey,
                "Content-Type: application/json"
            ]);

            $response = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($status === 200) {
                $data = json_decode($response, true);
                return $data['success'] ?? false;
            }

            return false;
        } catch (\Exception $e) {
            log_message('error', 'Cloudflare domain verification failed: ' . $e->getMessage());
            return false;
        }
    }

    private function isCloudflareIP($ip)
    {
        // Cloudflare IP ranges (you should update these periodically)
        $cloudflareIpv4Ranges = [
            '173.245.48.0/20',
            '103.21.244.0/22',
            '103.22.200.0/22',
            '103.31.4.0/22',
            '141.101.64.0/18',
            '108.162.192.0/18',
            '190.93.240.0/20',
            '188.114.96.0/20',
            '197.234.240.0/22',
            '198.41.128.0/17',
            '162.158.0.0/15',
            '104.16.0.0/13',
            '104.24.0.0/14',
            '172.64.0.0/13',
            '131.0.72.0/22'
        ];

        foreach ($cloudflareIpv4Ranges as $range) {
            if ($this->ipInRange($ip, $range)) {
                return true;
            }
        }

        return false;
    }

    private function ipInRange($ip, $range)
    {
        list($range, $netmask) = explode('/', $range, 2);
        $range_decimal = ip2long($range);
        $ip_decimal = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal = ~ $wildcard_decimal;
        return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
    }

    private function failedResponse($message, $code)
    {
        return service('response')
            ->setStatusCode($code)
            ->setJSON([
                'success' => false,
                'message' => $message
            ]);
    }
} 