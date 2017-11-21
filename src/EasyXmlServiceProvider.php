<?php
/**
 * Created by PhpStorm.
 * User: rmanzoor
 * Date: 11/20/2017
 * Time: 6:11 PM
 */

namespace RummyKhan\EasyXml;

use Illuminate\Support\ServiceProvider;

class EasyXmlServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('easy-xml', function () {
            return new XmlNodeFactory();
        });
    }
    public function provides()
    {
        return [
            'easy-xml'
        ];
    }
}