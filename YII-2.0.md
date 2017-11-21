# EasyXML for YII 2.0

## Installation

Install using composer

```bash
composer require rummykhan/easy-xml
```

## Add as component 
Add `easy-xml` to `config/web.php` components array.

```php
'components' => [
    'easy-xml' => [
        'class' => '\RummyKhan\EasyXml\XmlNodeFactory'
    ]
]
```

## How TO Build XML Nodes and hierarchies 

`Yii::$app->get('easy-xml')->create('person')` will give you instance of `RummyKhan\EasyXml\XmlNode` class.
[See api for `RummyKhan\EasyXml\XmlNode` class ](https://github.com/rummykhan/easy-xml#rummykhaneasyxmlxmlnode-api)


### 1. Using app container

```php

// Create a node
$rootNode = Yii::$app->get('easy-xml')->create('person');

$educationNode = Yii::$app->get('easy-xml')->create('education');
$educationNode->addAttributes(['MOE' => 'SXC', 'DAE' => 'COE', 'BA' => 'UOS']);
$rootNode->addChildNode($educationNode);

$jobNode = Yii::$app->get('easy-xml')->create('job');

$jobNode->addAttribute('first', 'https://best-bf.com');
$jobNode->addAttribute('second', 'https://infamous.ae');
$jobNode->addAttribute('third', 'https://awok.com');
$jobNode->addAttribute('fourth', 'https://helpbit.com');

$rootNode->addChildNode($educationNode)
    ->addChildNode($jobNode)
    ->setDeclaration(XmlDeclaration::V1);
    
dd((string)$rootNode);
```
will output

```xml
<?xml version="1.0" encoding="UTF-8"?>
<person>
   <education MOE="SXC" DAE="COE" BA="UOS" />
   <education MOE="SXC" DAE="COE" BA="UOS" />
   <education MOE="SXC" DAE="COE" BA="UOS" />
   <job first="https://best-bf.com" second="https://infamous.ae" third="https://awok.com" fourth="https://helpbit.com" />
</person>
```


### 2. Using Constructor Directly

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
```
