<?php

class Dbh
{
    protected function connect()
    {
        try {
            $host = "localhost";
            $dbname = "ooploginsystem";
            $user = "root";
            $pass = "";
            $port = 3306;
            $dsn = "mysql:host={$host};dbname={$dbname};port={$port};charset=utf8";
            $dbh = new PDO($dsn, $user, $pass);
            return $dbh;
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
            die();
        }
    }
}
