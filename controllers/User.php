<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 17:29
 */
class User extends Controller
{
    public function __construct()
    {

    }

    /**
     *
     */
    public function login()
    {
        $data = [
            'title' => 'Авторизация',
        ];
        $this->view('login', $data);
    }
}