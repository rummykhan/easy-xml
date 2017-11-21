# EasyXML

This package helps you in converting your data to XML easily.
This package is independent of any php framework.
But I took care of two popular frameworks specifically

1. Laravel
2. YII 2.0

## Installation

Install using composer

```php
composer require rummykhan/easy-xml
```

## How To Use

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


## For use in Laravel
[Easy XML Laravel Docs](https://github.com/rummykhan/easy-xml/blob/master/Laravel.md)

## For use in YII 2.0
[Easy XML YII Docs](https://github.com/rummykhan/easy-xml/blob/master/YII-2.0.md)

### Contact
[rehan_manzoor@outlook.com](mailto://rehan_manzoor@outlook.com)