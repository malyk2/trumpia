<?php

namespace Divart\Trumpia;

use Illuminate\Support\ServiceProvider;
//use Trumpia\TrumpiaRestApi;

class TrumpiaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
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
}
