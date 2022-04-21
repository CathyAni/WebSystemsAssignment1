<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;


// replace with file to your own project bootstrap
// require_once 'bootstrap.php';

$container = require 'config/container.php';

// replace with mechanism to retrieve EntityManager in your app
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    $container->get('doctrine.entity_manager.orm_default')
);