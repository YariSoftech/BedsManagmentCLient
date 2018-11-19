<?php

/**
 * Simple manual container for dependency injection
 */
require_once 'data/datasource/login_mysql.php';

class InjectionContainer {
    private static $pdo = null;

    public static function provideDatabaseInstance() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(
                    'mysql:dbname=' . DATABASE .
                    ';host=' . HOST . ";",
                    MYSQL_USER,
                    MYSQL_PASSWORD,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
                );

                // Habilitar excepciones
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {

                throw new ApiException(500, STATUS_CODE_500);
            }
        }

        return self::$pdo;

    }
}