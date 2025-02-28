<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ArrayCache;

require_once "vendor/autoload.php";

$isDevMode = true;
$proxyDir = null;

$cache = new ArrayCache();

$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . "/src/Domain"],
    $isDevMode,
    $proxyDir,
    $cache,
    false
);

$conn = [
    'driver' => 'pdo_mysql',
    'host' => 'mysql',       
    'dbname' => 'app_db',    
    'user' => 'user',       
    'password' => 'password', 
    'charset' => 'utf8mb4', 
];

$entityManager = EntityManager::create($conn, $config);

return $entityManager;