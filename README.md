# ZenDesk Remote

This library provide a REST client to ZenDesk remote call.
This project is based on [RestRemoteObject](https://github.com/fourmation/RestRemoteObject) which allow to control a REST API with objects.

[![Build Status](https://api.travis-ci.org/fourmation/ZenDeskRemoteObject.png?branch=master)](https://travis-ci.org/fourmation/ZenDeskRemoteObject)
[![Coverage Status](https://coveralls.io/repos/fourmation/ZenDeskRemoteObject/badge.png?branch=master)](https://coveralls.io/r/fourmation/ZenDeskRemoteObject)
[![Latest Stable Version](https://poser.pugx.org/fourmation/zendesk-remote-object/v/stable.png)](https://packagist.org/packages/fourmation/zendesk-remote-object)
[![Latest Unstable Version](https://poser.pugx.org/fourmation/zendesk-remote-object/v/unstable.png)](https://packagist.org/packages/fourmation/zendesk-remote-object)

## Installation

```sh
php composer.phar require "fourmation/zendesk-remote-object:0.6.*"
```

## Architecture

This project use Zend\ServiceManager to create entities or services. Each new entities or service calls must use the ServiceManager.
Each entity and service pilot a remote rest proxy to call remote API. To know how to do remote call, read the ZenDeskRemoteObject documentation.

## Usage example

All examples are in the `examples/` folder.

* retrieve current user :

```php
$userService = $serviceManager->get('ZenDesk\Service\UserService');
$user = $userService->me();

var_dump($user->getName()); // current user name
```

* update the user :
```php
$user->setName('Vincent Blanchon');
$user->save();
```

* create user :
```php
$user = new ZenDesk\Entity\User();
$user->setName('Vincent Blanchon');
$user->setEmail('email@email.com.au');

$service = $serviceManager->get('ZenDesk\Service\UserService');
$service->persist($user);

var_dump($user->getId());
```

* create ticket :
```php
$ticket = new ZenDesk\Entity\Ticket();
$ticket->setSubject('My first ticket');
$ticket->setDescription('French will win the soccer world cup');
$ticket->setStatus('pending');

$service = $serviceManager->get('ZenDesk\Service\TicketService');
$service->persist($ticket);

var_dump($ticket->getId()); // there is now an id
```

## Zend Framework 2 integration

A `Module.php` file is provided, you can also use this project like a Zend Framework 2 module.

## Features list

Entity :
* User : create, update, delete, get tickets, suspend
* Ticket : create, update, delete, add comments, get tags, close
* TicketField : create, update, delete
* UserField : create, update, delete
* OrganizationField : create, update, delete
* Trigger : create, update, delete
* Automation : create, update, delete
* Macro : create, update, delete
* View : create, update, delete, get tickets

Service :
* User : get, get current, list, search, autocomplete
* Ticket : get, list, list recent, search
* TicketField : get, list
* UserField : get, list
* OrganizationField : get, list
* Tags : list
* Trigger : list, get
* Automation : list, get
* Macro : get, list
* View : get, list, list active
* Search : user, ticket
