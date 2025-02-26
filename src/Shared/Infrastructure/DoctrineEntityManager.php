<?php

declare(strict_types=1);

namespace Jorgeaguero\Docfav\Shared\Infrastructure;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

class DoctrineEntityManager
{
    private static ?EntityManager $entityManager = null;

    /**
     * Get the EntityManager instance
     * @param string $host Database host
     * @param string $dbname Database name
     * @param string $user Database user
     * @param string $password Database password
     * @return EntityManager
     */
    public static function getEntityManager(
        string $host,
        string $dbname,
        string $user,
        string $password
    ): EntityManager {
        if (self::$entityManager === null) {

            // Doctrine configuration
            $config = ORMSetup::createXMLMetadataConfiguration(
                paths: [__DIR__ . '/Doctrine'],
                isDevMode: true
            );

            // Connection configuration
            $connection = DriverManager::getConnection([
                'driver'   => 'pdo_mysql',
                'host'     => $host,
                'dbname'   => $dbname,
                'user'     => $user,
                'password' => $password,
            ], $config);

            self::$entityManager = new EntityManager($connection, $config);
        }

        return self::$entityManager;
    }
}
