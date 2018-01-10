<?php

namespace Divart\Trumpia;

use Illuminate\Support\ServiceProvider;

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
