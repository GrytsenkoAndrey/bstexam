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
         $this->m = $this->model('userModel');
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

    /**
     *
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'login' => strip_tags(trim($_POST['login'])),
                'password' => strip_tags(trim($_POST['password'])),
                'confirm' => strip_tags(trim($_POST['confirm'])),
                'login_error' => '',
                'password_error' => '',
                'confirm_error' => '',
                'title' => 'Регистрация',
            ];
            if (empty($data['login'])) {
                $data['login_error'] = 'Введите правильный адрес почты';
            } else {
                if ($this->m->findUserByLogin($data['login'])) {
                    $data['login_error'] = 'E-mail занят';
                }
            }
            if (empty($data['password'])) {
                $data['password_error'] = 'Введите пароль';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Пароль должен быть больше 5 символов';
            }

            if (empty($data['confirm'])) {
                $data['confirm_error'] = 'Подтвердите пароль';
            } else {
                if ($data['password'] != $data['confirm']) {
                    $data['confirm_error'] = 'Пароли неодинаковы';
                }
            }

            if (empty($data['login_error']) && empty($data['password_error']) && empty($data['confirm_error'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->m->register($data)) {
                    header('Location: user/login');
                } else {
                    die('wrong');
                }
            } else {
                $this->view('register', $data);
            }
        } else {
            $data = [
                'login' => '',
                'password' => '',
                'confirm_password' => '',
                'login_error' => '',
                'password_error' => '',
                'confirm_error' => '',
                'title' => 'Регистрация',
            ];
            $this->view('register', $data);
        }
    }

    public function contacts()
    {

    }

    public function favorite()
    {

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-3600);
        header('Location: ' . URLROOT);
    }
}