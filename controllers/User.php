<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 17:29
 */
class User extends Controller
{
    # model
    private $m;

    /**
     * save model
     */
    public function __construct()
    {
         #$this->m = $this->model('User');
    }

    /**
     * login page
     */
    public function login()
    {
        $data = [
            'title' => 'Авторизация',
        ];
        $this->view('login', $data);
    }

}