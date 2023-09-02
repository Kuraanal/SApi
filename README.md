# SApi

Simple CRUD api system.

## About

This is a simple API class meant to be easy to use without to much configuration.

## Basic Usage

The minimum setup needed to use the Logger class.

#### **_SQL request without parameters_**

```php

<?php
require_once("vendor/autoload.php");

use Kuran\SApi\Api;

$db = new PDO();

$sqlQuery = "SELECT
                    users.name,
                    users.email,
                    users.address
                FROM users";

$queryParams = [];

$api = new Api($db);

$api->setQueryString($sqlQuery);

echo $api->readAll($queryParams);


```

#### **_SQL request with named parameters_**

```php

$sqlQuery = "SELECT
                    users.name,
                    users.email,
                    users.address
                FROM users
                WHERE users.id = :id
                AND users.name = :name";

$queryParams = ["id" => 2, "name" => "username"];

```

#### **_SQL request with dynamic parameters_**

```php

$sqlQuery = "SELECT
                    users.name,
                    users.email,
                    users.address
                FROM users
                WHERE users.id = ?
                AND users.name = ?";

$queryParams = [2, "username"];

```

## Class methods

```php

// readAll().
// Will fetch all matching rows from the database.
$api->readAll(array());

//readOne().
// Will fetch one matching row from the database.
$api->readOne(array());

//create().
// Insert data to the database
$api->create(array());

//update()
// Will update a row from the database.
$api->update(array());

//delete()
// Will delete an entry from the database
$api->delete(array());

```
