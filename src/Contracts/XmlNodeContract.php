<?php
/**
 * Created by PhpStorm.
 * User: rummykhan
 * Date: 11/20/2017
 * Time: 4:38 PM
 */

namespace RummyKhan\EasyXml\Contracts;

interface XmlNodeContract
{
    /**
     * Create XML Node either by value or attribute or both
     *
     * XmlNodeContract constructor.
     * @param string $name
     * @param null $value
     * @param array $attributes
     * @param array $config
     */
    public function __construct(string $name, $value = null, array $attributes = [], array $config = []);

    /**
     * Add Child node for the current xml node
     *
     * @param $xmlNode
     * @param null $value
     * @param array $attributes
     * @return mixed
     */
    public function addChildNode($xmlNode, $value = null, array $attributes = []);

    /**
     * set top xml declaration
     *
     * @param $declaration
     * @return mixed
     */
    public function setDeclaration($declaration);

    /**
     * convert an xml node to string.
     *
     * @param bool $addDeclaration
     * @param bool $refreshCache
     * @return string
     * @throws \Exception
     */
    public function toString($addDeclaration = true, $refreshCache = true);

    /**
     * Set the value of this node.
     * @param $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Add attribute for the node.
     * @param $key
     * @param $value
     * @return mixed
     */
    public function addAttribute($key, $value);

    /**
     * Add multiple attributes to the node.
     * @param array $attributes
     * @param bool $overRide
     * @return mixed
     */
    public function addAttributes(array $attributes, $overRide = false);
}