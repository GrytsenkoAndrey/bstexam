<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 18:10
 */

class UserModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = Db::getInstance()->getConnection();
    }

    public function register(array $data)
    {

    }

    public function login(array $data)
    {

    }
}