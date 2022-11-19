<?php

require_once(dirname(__FILE__) . '/../config/init.php');

class Database
{
    public static function dbConnect(): object
    {
        try {
            $pdo = new PDO(DSN, USER, PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (PDOException $e) {
            header('location: /controllers/errorController.php?error=1');
            die;
        }
        return $pdo;
    }
}
