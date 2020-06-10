<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 17:29
 */
class User extends Controller
{
    /**
     * @var модель
     */
    private $m;

    /**
     * проверяем авторизован ли пользователь
     */
    use CheckId;

    /**
     * save model
     */
    public function __construct()
    {
         $this->m = $this->model('userModel');
    }

    /**
     * авторизация
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'login' => strip_tags(trim($_POST['login'])),
                'password' => strip_tags(trim($_POST['password'])),
                'login_error' => '',
                'password_error' => '',
                'title' => 'Авторизация',
            ];
            if (empty($data['login'])) {
                $data['login_error'] = 'Введите правильный адрес почты';
            }
            if (empty($data['password'])) {
                $data['password_error'] = 'Введите пароль';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Пароль должен быть больше 5 символов';
            }

            if (empty($data['login_error']) && empty($data['password_error'])) {
                if ($this->m->login($data)) {
                    header('Location: ' . URLROOT . 'user/contacts/');
                } else {
                    die('Ошибка авторизации');
                }
            } else {
                $_SESSION['infoMsg'] = '';
                $this->view('login', $data);
            }
        } else {
            $data = [
                'login' => '',
                'password' => '',
                'login_error' => '',
                'password_error' => '',
                'title' => 'Авторизация',
            ];
            $this->view('login', $data);
        }
    }

    /**
     * регистрация
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
                $_SESSION['infoMsg'] = '';
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

    /**
     * контакты
     */
    public function contacts()
    {
        $this->issetId();
        $data = [
            'title' => 'Контакты',
            'contacts' => $this->m->getAllUsers(),
        ];
        $this->view('contacts', $data);
    }

    /**
     * избранные
     */
    public function favorite()
    {
        $this->issetId();
        $data = [
            'title' => 'Избранные',
            'favorites' => $this->m->getFavoriteForUser(),
        ];
        $this->view('favorite', $data);
    }

    /**
     * выход
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-3600);
        header('Location: ' . URLROOT);
    }

    public function add($id)
    {
        $this->issetId();
        $this->m->addToFavorite($id);
    }
}