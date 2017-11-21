# EasyXML for Laravel

## Installation

Install using composer

```bash
composer require rummykhan/easy-xml
```

## Add Service Provider
Add `ServiceProvider` to `config/app.php` providers array.

```php
\RummyKhan\EasyXml\EasyXmlServiceProvider::class,
```

## Add Facade
To use with Facade add

```php
'EasyXML' => \RummyKhan\EasyXml\EasyXMLFacade::class,
```

## How TO Build XML Nodes and hierarchies 

`app('easy-xml')->create('person')` OR `EasyXmlFacade::create('person')` will give you instance of `RummyKhan\EasyXml\XmlNode` class.
[See api for `RummyKhan\EasyXml\XmlNode` class ](https://github.com/rummykhan/easy-xml#rummykhaneasyxmlxmlnode-api)

### 1. Using app container

```php
// Create a node
$rootNode = app('easy-xml')->create('person');

$educationNode = app('easy-xml')->create('education');
$educationNode->addAttributes(['MOE' => 'SXC', 'DAE' => 'COE', 'BA' => 'UOS']);
$rootNode->addChildNode($educationNode);

$jobNode = app('easy-xml')->create('job');

$jobNode->addAttribute('first', 'https://best-bf.com');
$jobNode->addAttribute('second', 'https://infamous.ae');
$jobNode->addAttribute('third', 'https://awok.com');
$jobNode->addAttribute('fourth', 'https://helpbit.com');

$rootNode->addChildNode($educationNode)
    ->addChildNode($jobNode)
    ->setDeclaration(XmlDeclaration::V1);

dd((string)$rootNode); // since it implements __toString()
//or
dd($rootNode->toString());
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

### 2. Using Facade

```php
$rootNode = EasyXmlFacade::create('person');

$jobNode = EasyXmlFacade::create('job');

$jobNode->addAttribute('first', 'https://best-bf.com');
$jobNode->addAttribute('second', 'https://infamous.ae');
$jobNode->addAttribute('third', 'https://awok.com');
$jobNode->addAttribute('fourth', 'https://helpbit.com');

$rootNode->addChildNode($jobNode)
    ->setDeclaration(XmlDeclaration::V1);

dd((string)$rootNode);
```

will output

```xml
<?xml version="1.0" encoding="UTF-8"?>
<person>
   <job first="https://best-bf.com" second="https://infamous.ae" third="https://awok.com" fourth="https://helpbit.com" />
</person>
```


### 3. Using Constructor Directly

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
