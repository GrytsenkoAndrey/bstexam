<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 20:01
 */
trait CheckId
{
    public static function issetId()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['infoMsg'] = '<div class="alert alert-danger">Вы не можете просматривать данный раздел без авторизации</div>';
            header('Location: ' . URLROOT . 'user/login/');
        }
    }
}