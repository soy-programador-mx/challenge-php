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
     * @return EntityManager
     */
    public static function getEntityManager(): EntityManager
    {
        if (self::$entityManager === null) {

            // Doctrine configuration
            $config = ORMSetup::createXMLMetadataConfiguration(
                paths: [__DIR__ . '/Doctrine'],
                isDevMode: true
            );

            // Connection configuration
            $connection = DriverManager::getConnection([
                'driver'   => 'pdo_mysql',
                'host'     => getenv('MYSQL_HOST'),
                'dbname'   => getenv('MYSQL_DATABASE'),
                'user'     => getenv('MYSQL_USER'),
                'password' => getenv('MYSQL_PASSWORD'),
            ], $config);

            self::$entityManager = new EntityManager($connection, $config);
        }

        return self::$entityManager;
    }
}
