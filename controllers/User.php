<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 17:29
 */
class User extends Controller
{
    protected $model;
    protected $view;

    public function __construct()
    {

    }

    /**
     *
     */
    public function login()
    {
        $conn = Db::getInstance()->getConnection();
        var_dump($conn);
    }
}