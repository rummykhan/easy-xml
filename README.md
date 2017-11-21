# EasyXML

This package helps you in converting your data to XML easily.
This package is independent of any php framework.
But I took care of two popular frameworks specifically

1. [For use in Laravel](https://github.com/rummykhan/easy-xml/blob/master/Laravel.md)
2. [For use in YII 2.0](https://github.com/rummykhan/easy-xml/blob/master/YII-2.0.md)

## To use in any framework

Wit the constructor initialization you can use it any framework you may like.

```php
$rootNode = new XmlNode('person');

$educationNode = new XmlNode('education');
$educationNode->addAttributes(['MOE' => 'SXC', 'DAE' => 'COE', 'BA' => 'UOS']);
$rootNode->addChildNode($educationNode);

$jobNode = new XmlNode('job');

$jobNode->addAttribute('first', 'https://best-bf.com');
$jobNode->addAttribute('second', 'https://infamous.ae');
$jobNode->addAttribute('third', 'https://awok.com');
$jobNode->addAttribute('fourth', 'https://helpbit.com');

$rootNode->addChildNode($jobNode)
    ->setDeclaration(XmlDeclaration::V1);

// since it implements php __toString() method
dd((string)$rootNode);
// OR
dd($rootNode->toString());
```

will output

```xml
<?xml version="1.0" encoding="UTF-8"?>
<person>
   <education MOE="SXC" DAE="COE" BA="UOS" />
   <job first="https://best-bf.com" second="https://infamous.ae" third="https://awok.com" fourth="https://helpbit.com" />
</person>
```


## `RummyKhan\EasyXml\XmlNode` API

### `addChildNode`

To add a child node to XmlNode.
e.g.

```php
$rootNode = new XmlNode('employees');
$employeeNode = new XmlNode('employee');

$rootNode->addChildNode($employeeNode);
```

### `setDeclaration`
To set the [Xml declaration](http://xmlwriter.net/xml_guide/xml_declaration.shtml)

```php
$rootNode = new XmlNode('employees');
$rootNode->setDeclaration('<?xml version="1.0" encoding="UTF-8" standalone="no" ?>');
```

### `setValue`
To set the value of the node. Node can either have other node as children or it has a primitive value.

```php
$rootNode = new XmlNode('name');
$rootNode->setValue('rummykhan');
```

### `addAttribute`
To add the attribute for the xml node.

```php
$rootNode = new XmlNode('person');
$rootNode->addAttribute('age', 30);
```

### `addAttributes`
To add multiple attributes for the xml node.
e.g.

```php
$rootNode = new XmlNode('person');
$rootNode->addAttributes([
    'name' => 'rummykhan',
    'age' => 30
]);
```


### `toString`
To convert xml single node or xml node hierarchy to xml string.

```php
$rootNode = new XmlNode('employees');
dd($rootNode->toString());
```

### Contact
[rehan_manzoor@outlook.com](mailto://rehan_manzoor@outlook.com)