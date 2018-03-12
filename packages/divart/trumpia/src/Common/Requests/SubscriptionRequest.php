<?php
namespace Divart\Trumpia\Common\Requests;

use Divart\Trumpia\Common\RestRequest;

class SubscriptionRequest extends RestRequest
{

    public function __construct()
    {
        $this->uri = 'subscription';

        $this->fields = ['list_name', 'subscriptions'];

        $this->params = [
            'PUT' => [
                'validate' => [
                    'list_name' => 'required|string',
                    'subscriptions' => 'required|array|trumpia_is_subscriptions'
                ]
            ],
            'GET' => [

            ],
            'POST' => [
                'validate' => [
                    //'list_name' => 'required|string',
                    //'subscriptions' => 'required|string'
                ]
            ],
            'DELETE' => [

            ],
        ];
        parent::__construct();
    }

}
