<?php

namespace CDshop;

use PDO;
use PDOException;

abstract class Db
{
    private static $conn = null;

    public static function getInstance()
    {
        try {
            if (isset(self::$conn)) {
                // Connection found! return it
                    return self::$conn;
            } else {
                // No connection found. Create the connection! return it
                self::$conn = new PDO("mysql:host=localhost; dbname=cdshop", "Webgebruiker", "Labo2018");
                return self::$conn;
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
