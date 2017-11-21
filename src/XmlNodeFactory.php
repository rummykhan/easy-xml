<?php
/**
 * Created by PhpStorm.
 * User: rummykhan
 * Date: 11/20/2017
 * Time: 5:34 PM
 */

namespace RummyKhan\EasyXml;

use RummyKhan\EasyXml\Contracts\XmlNodeFactoryContract;

class XmlNodeFactory implements XmlNodeFactoryContract
{
    public function create($name)
    {
        return new XmlNode($name);
    }
}