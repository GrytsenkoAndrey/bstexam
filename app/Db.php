<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 17:38
 */

class Db
{
    private $host = DB_HOST;
    private $db   = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private $connection;
    private static $instance;

    /**
     * set connection
     */
    private function __construct()
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
            $opt = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+03:00'",
            ];
            $this->connection = new \PDO($dsn, $this->user, $this->pass, $opt);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * @return Db
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * disable clone
     */
    private function __clone() {}
}
