<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 16:47
 */

require_once 'config/config.php';

set_include_path(get_include_path()
    .PATH_SEPARATOR . 'app'
    .PATH_SEPARATOR . 'controllers'
    .PATH_SEPARATOR . 'models'
);

spl_autoload_register(function ($class) {
    require_once $class . '.php';
});
