<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 16:47
 */

require_once 'config/config.php';

spl_autoload_register(function ($class) {
    require_once 'app/' . $class . '.php';
});
