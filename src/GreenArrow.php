<?php

namespace Bcismariu\GreenArrow;

use Http\Client\HttpClient;
use GuzzleHttp\Psr7\Request;

class GreenArrow
{
    
    private $settings = [
        'password' => '',
        'username' => '',
        'host' => '',
        'protocol' => 'https',
        'version' => 'v1',
        'endpoint' => 'send.json'
    ];
    
    protected $http_client;
    
    public function __construct(httpClient $httpClient, $options = [])
    {
        $this->setOptions($options);
        $this->httpClient = $httpClient;
    }
    
    public function send($payload, $headers = [])
    {
        $request = $this->buildRequest($payload, $headers);
        
        return new Response($this->httpClient->sendRequest($request));
    }
    
    /**
     * Builds request from given params.
     *
     * @param array  $payload
     * @param array  $headers
     * @param string $method
     *
     * @return GuzzleHttp\Psr7\Request - A Psr7 compliant request
     */
    private function buildRequest($payload, $headers, $method = 'POST')
    {
        $method = trim(strtoupper($method));
        
        $payload['username'] = $this->settings['username'];
        $payload['password'] = $this->settings['password'];
    
        $url = $this->buildUrl();
        $headers = $this->getHttpHeaders($headers);
    
        return new Request($method, $url, $headers, json_encode($payload));
    }
    
    /**
     * Returns an array for the request headers.
     *
     * @param array $headers - any custom headers for the request
     *
     * @return array $headers - headers for the request
     */
    private function getHttpHeaders($headers = [])
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json'
        ];
    
        foreach ($defaultHeaders as $key => $value) {
            $headers[$key] = $value;
        }
    
        return $headers;
    }
    
    private function setOptions($options)
    {
        if (!isset($options['password']) || !isset($options['username'])) {
            throw new Exception("Please provide password and username");
        }
        
        foreach ($options as $option => $value) {
            if ($this->isOptionValid($option)) {
                $this->settings[$option] = $value;
            }
        }
    }

    protected function isOptionValid($option)
    {
        return array_key_exists($option, $this->settings);
    }
    
    /**
     * Builds the request url from the options.
     *
     * @return string $url - the url to send the desired request to
     */
    protected function buildUrl()
    {
        return $this->settings['protocol']
            . '://'
            . $this->settings['host']
            . '/api/'
            . $this->settings['version']
            . '/'
            . $this->settings['endpoint']
        ;
    }
}
