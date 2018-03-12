<?php

namespace Divart\Trumpia;

use Illuminate\Support\ServiceProvider;
//use Trumpia\TrumpiaRestApi;
use Illuminate\Support\Facades\Validator;
use Divart\Trumpia\Exceptions\ValidateException;

class TrumpiaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addValidationRules();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('trumpiarestapi', function($app)
        {
            return new TrumpiaRestApi();
        });
        // $this->app->singleton('paypalpayment', function($app)
        // {
        //     return new PaypalPayment();
        // });
        // $this->app->singleton('Aimeos\Shop\Base\Aimeos', function($app) {
        //     dd('stop');
		// 	return new \Aimeos\Shop\Base\Aimeos($app['config']);
		// });

        $this->registerPublish();
    }

    private function registerPublish()
    {
        $basePath = __DIR__.'/../';
        $arrPublish = [
            'config' => [
                $basePath.'publish/config' => config_path('')
            ]
        ];
        foreach ($arrPublish as $group => $path) {
            $this->publishes($path, $group);
        }
    }

    private function addValidationRules()
    {
        Validator::extend('trumpia_is_phone_object', function ($attribute, $value, $parameters, $validator) {
            $rules = [
                'number' => 'required|numeric',
                'country_code' => 'required|numeric',
            ];
            $check = Validator::make($value, $rules);
            if ($check->fails()) {
                throw new ValidateException($check->errors());
            }
            return true;
        });

        Validator::extend('trumpia_is_subscriptions', function ($attribute, $value, $parameters, $validator) {
            foreach($value as $key => $item) {
                $rules[$key.'.first_name'] = 'required|string';
                $rules[$key.'.last_name'] = 'required|string';
                $rules[$key.'.email'] = 'required|email';
                $rules[$key.'.voice_device'] = 'required|in:landline,mobile';
                $rules[$key.'.mobile'] = 'required_if:'.$key.'.voice_device,mobile|array|trumpia_is_phone_object';
                $rules[$key.'.landline'] = 'required_if:'.$key.'.voice_device,landline|array|trumpia_is_phone_object';
            }
            $check = Validator::make($value, $rules);
            if ($check->fails()) {
                throw new ValidateException($check->errors());
            }
            return true;
        });
    }
}
