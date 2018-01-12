<?php
namespace Divart\Trumpia\Common\Requests;

use Divart\Trumpia\Common\RestRequest;

class ListRequest extends RestRequest
{

    public function __construct()
    {
        $this->uri = 'list';

        $this->fields = ['list_name', 'display_name', 'frequency', 'description'];

        $this->params = [
            'PUT' => [
                'validate' => [
                    'list_name' => 'required|string',
                    'display_name' => 'required|string|max:50',
                    'frequency' => 'required|integer|max:999',
                    'description' => 'required|string|max:20'
                ]
            ],
            'GET' => [

            ],
            'POST' => [
                'validate' => [
                    'list_name' => 'required|string',
                    'display_name' => 'required|string|max:50',
                    'frequency' => 'required|integer|max:999',
                    'description' => 'required|string|max:20'
                ]
            ],
            'DELETE' => [

            ],
        ];
        parent::__construct();
    }



}
