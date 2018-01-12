<?php
namespace Divart\Trumpia\Common;

use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

use Divart\Trumpia\Exceptions\EmptyConfigException;
use Divart\Trumpia\Exceptions\ValidateException;

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

    protected $body = [];

    protected $fields = [];

    protected $params = [];

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->client = new GuzzleClient();
        $this->output = new ArrayRestInterface();
        $this->throwsConfig();
    }

    public function get($id = null)
    {
        $this->setMethod('GET');
        $this->setUri($id);
        $this->initRequest();
        return $this->loadResponse();
    }

    public function create($data = [])
    {
        $this->setMethod('PUT');
        $this->setBody($data);
        $this->initRequest();
        return $this->loadResponse();
    }

    public function update($id,  $data = [])
    {
        $this->setMethod('POST');
        $this->setUri($id);
        $this->setBody($data);
        $this->initRequest();
        return $this->loadResponse();
    }

    public function delete($id = false)
    {
        $this->setMethod('DELETE');
        $this->setUri($id);
        $this->initRequest();
        return $this->loadResponse();
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
        $body = $this->getBody();
        $options = [];
        if ( count($body)) {
            $options['json'] = $body;
        }
        try {
            $response = $this->client->send($this->request, $options);
        } catch (GuzzleRequestException $e){
            return $this->returnResponse($e->getResponse());
        }
        return $this->returnResponse($response);
    }

    private function returnResponse(GuzzleResponse $response)
    {
        return $this->output->output($response);
    }

    private function getUri()
    {
        return $this->uri;
    }

    private function setUri($uri = '')
    {
        $this->uri .=  ! empty($uri) ? '/'.$uri : '';
    }

    private function getMethod()
    {
        return $this->method;
    }

    private function setMethod($method)
    {
        $this->method = $method;
        $this->throwsAllowedMethods();
    }

    private function getBody()
    {
        return $this->body;
    }

    private function setBody($data)
    {
        $this->body = $this->validate($data);
    }

    private function getFullUrl()
    {
        $url = RestConst::TRUMPIA_RESR_URL.'/'.RestConst::VERSION.'/'.config('trumpia.username').'/'.$this->getUri();
        return $url;
    }

    private function getHeaders()
    {
        $headers = ['Content-Type' => 'application/json','X-Apikey' => config('trumpia.apiKey')];
        return $headers;
    }

    private function validate($data)
    {
        $filteredData = array_only($data, $this->fields);
        $params = $this->params[$this->method];
        $rules = array_key_exists('validate', $params) ? $params['validate'] : [];
        $validator = Validator::make($filteredData, $rules);
        if ($validator->fails()) {
            throw new ValidateException($validator->errors());
        }
        return $filteredData;
    }

    private function throwsAllowedMethods()
    {
        if ( ! array_key_exists($this->method, $this->params)) {
            throw new \Exception('Not allowed method for '.$this->uri);
        }
    }

    private function throwsConfig()
    {
        if (empty(config('trumpia.apiKey'))) {
            throw new EmptyConfigException('Not set value for apiKey in trumpia config');
        } elseif(empty(config('trumpia.username'))) {
            throw new EmptyConfigException('Not set value for apiKey in trumpia config');
        }
    }



}
