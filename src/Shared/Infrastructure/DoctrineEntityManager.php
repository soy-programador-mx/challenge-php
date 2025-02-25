<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Shared\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

class DoctrineEntityManager
{
    private static ?EntityManager $entityManager = null;

    public static function getEntityManager(): EntityManager
    {
        if (self::$entityManager === null) {

            // Configuración de Doctrine
            $config = ORMSetup::createAttributeMetadataConfiguration(
                paths: [__DIR__ . '/../src/Entity'],
                isDevMode: true
            );

            // Configuración de la conexión
            $connection = DriverManager::getConnection([
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'docfav',
                'user'     => 'root',
                'password' => '',
            ], $config);

            self::$entityManager = new EntityManager($connection, $config);
        }

        return self::$entityManager;
    }
}
