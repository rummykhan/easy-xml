<?php
/**
 * Created by PhpStorm.
 * User: rmanzoor
 * Date: 11/20/2017
 * Time: 6:13 PM
 */

namespace RummyKhan\EasyXml;

use Illuminate\Support\Facades\Facade;

class EasyXmlFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'easy-xml';
    }
}