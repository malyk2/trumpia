<?php
namespace Divart\Trumpia\Common;

use \GuzzleHttp\Client as GuzzleClient;
use \GuzzleHttp\Psr7\Request as GuzzleRequest;
use \GuzzleHttp\Psr7\Response as GuzzleResponse;
use \GuzzleHttp\Exception\RequestException as GuzzleRequestException;

use Divart\Trumpia\Exceptions\EmptyConfigException;
use Divart\Trumpia\Common\Interfaces\ArrayRestInterface;

/**
 * @property string method
 */
class RestRequest
{
    protected $client;

    protected $request;

    protected $response;

    protected $method;

    protected $uri;

    protected $output;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->client = new GuzzleClient();
        $this->output = new ArrayRestInterface();
        $this->throws();
    }

    public function get($params = null)
    {
        if ( ! empty($params)) {
            $this->uri .= '/'.$params;
        }
        $this->initRequest();
        $response = $this->loadResponse();
        return $response;
    }

    private function initRequest()
    {
        $method = $this->getMethod();
        $url = $this->getFullUrl();
        $headers = $this->getHeaders();
        $this->request = new GuzzleRequest($method, $url, $headers);
    }

    private function loadResponse()
    {
        try {
            $response = $this->client->send($this->request);
        } catch (GuzzleRequestException $e){
            return $this->returnResponse($e->getResponse());
        }

        return $this->returnResponse($response);
    }

    private function returnResponse(GuzzleResponse $response)
    {
        return $this->output->output($response);
    }

    private function getMethod()
    {
        return $this->method;
    }

    private function getFullUrl()
    {
        $url = RestConst::TRUMPIA_RESR_URL.'/'.RestConst::VERSION.'/'.config('trumpia.username').'/'.$this->uri;
        return $url;
    }

    private function getHeaders()
    {
        $headers = ['Content-Type' => 'application/json','X-Apikey' => config('trumpia.apiKey')];
        return $headers;
    }

    private function handleRequest()
    {
        // $url = RestConst::TRUMPIA_RESR_URL.config('trumpia.username').'/'.$this->uri;
        // $headers = ['Content-Type' => 'application/json','X-Apikey' => config('trumpia.apiKey')];
        // $this->request = new GuzzleRequest($this->method, $url, $headers);
        //$this->request = new GuzzleRequest($this->method);
        //dd($this->request);

        //$response = $this->client->send($this->request);

        //echo $response->getStatusCode();
        //echo $response->getContents();
        //dd(json_decode($response->getBody(), true));
    }

    private function throws()
    {
        if (empty(config('trumpia.apiKey'))) {
            throw new EmptyConfigException('Not set value for apiKey in trumpia config');
        } elseif(empty(config('trumpia.username'))) {
            throw new EmptyConfigException('Not set value for apiKey in trumpia config');
        }
    }

}
