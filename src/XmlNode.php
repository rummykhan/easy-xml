<?php
/**
 * Created by PhpStorm.
 * User: rummykhan
 * Date: 11/20/2017
 * Time: 2:46 PM
 */

namespace RummyKhan\EasyXml;

use LibXMLError;
use RummyKhan\EasyXml\Contracts\XmlNodeContract;

class XmlNode implements XmlNodeContract
{
    /**
     * node name
     * @var string $name
     */
    protected $name = null;

    /**
     * value for the node
     * @var null
     */
    protected $value = null;

    /**
     * attribute of the node.
     * @var array
     */
    protected $attributes = [];

    /**
     * if the node is self closing or not.
     * @var bool
     */
    private $selfClosing = false;

    /**
     * Actual output of the string.
     *
     * @var string
     */
    protected $cache = '';

    /**
     * Top level of the XML Document declaration.
     * @var null
     */
    protected $declaration = null;

    /**
     * Children of the nodes.
     * @var array $children
     */
    protected $children = [];

    /**
     * @inheritdoc
     */
    public function __construct(string $name, $value = null, array $attributes = [], array $config = [])
    {
        $this->name = $name;
        $this->value = $value;
        $this->attributes = $attributes;
        $this->selfClosing = empty($value);
    }

    /**
     * @inheritdoc
     */
    public function addChildNode($xmlNode, $value = null, array $attributes = [])
    {
        if (!$xmlNode instanceof static) {
            $xmlNode = new static($xmlNode, $value, $attributes);
        }

        $this->children[] = $xmlNode;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setDeclaration($declaration)
    {
        $this->declaration = $declaration;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toString($addDeclaration = true, $invalidateCache = true)
    {
        if (!empty($this->cache) && !$invalidateCache) {
            return $this->cache;
        }

        if ($addDeclaration || !empty($this->declaration)) {
            $this->addXMLDeclaration();
        }

        $this->parseNodeAsXML();

        return $this->cache;
    }

    /**
     * Actual parsing of XML node as string
     */
    protected function parseNodeAsXML()
    {
        $this->startRoot();
        $this->addRootValue();
        $this->parseChildren();
        $this->closeRoot();
        $this->validate();
    }

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = htmlspecialchars($value);
    }

    /**
     * @inheritdoc
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes, $overRide = false)
    {
        $this->attributes = $overRide ? $attributes : array_merge($attributes);
    }

    /**
     * Add declaration to XML output string.
     */
    protected function addXMLDeclaration()
    {
        if (!$this->declaration) {
            return;
        }

        $this->cache = $this->declaration;
    }

    /**
     * Start node.
     * @return $this
     */
    protected function startRoot()
    {
        $tagString = "{$this->name}";
        if (!empty($this->attributes)) {
            $tagString .= ' ' . $this->getAttributesString();
        }

        if ($this->selfClosing && empty($this->children)) {
            $this->cache .= "<{$tagString}/>";
        } else {
            $this->cache .= "<{$tagString}>";
        }

        return $this;
    }

    /**
     * Add root node value if there is any.
     * @return $this
     */
    protected function addRootValue()
    {
        // if there are children nodes, it cannot have value

        if (!empty($this->children)) {
            return $this;
        }

        // if there are no children nodes, only then it can have value.
        if (!$this->selfClosing) {
            $this->cache .= $this->value;
        }

        return $this;
    }

    /**
     * Close node if it need to be closed.
     * @return $this
     */
    protected function closeRoot()
    {
        if (!$this->selfClosing || !empty($this->children)) {
            $this->cache .= "</{$this->name}>";
        }

        return $this;
    }

    /**
     * Parse node children one by one.
     * @return $this
     */
    protected function parseChildren()
    {
        foreach ($this->children as $child) {
            $this->cache .= $this->parseChild($child);
        }

        return $this;
    }

    /**
     * Parse xml node as a string.
     * @param XmlNode $child
     * @return string
     */
    protected function parseChild(XmlNode $child)
    {
        return (string)$child;
    }

    /**
     * Get attribute key value pairs as string compatible for xml attributes
     * @return string
     */
    protected function getAttributesString()
    {
        $string = '';

        foreach ($this->attributes as $key => $value) {
            $string .= $key . '="' . htmlspecialchars($value) . '" ';
        }

        return trim($string);
    }

    /**
     * Validate XML string produced.
     * @return bool
     * @throws \Exception
     */
    protected function validate()
    {
        libxml_use_internal_errors(true);
        $loaded = simplexml_load_string($this->cache);

        if (false === $loaded) {
            /**
             * @var LibXmlError $error
             */
            foreach (libxml_get_errors() as $error) {
                throw new \Exception($error->message);
            }
        }

        return true;
    }

    /**
     * Mehtod to get the string value produced by
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->toString();
    }
}