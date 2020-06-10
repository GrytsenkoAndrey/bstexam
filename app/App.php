<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 16:52
 */
class App
{
    private $controller = 'user';
    private $action = 'login';
    private $params = [];
    private static $instance;

    /**
     * call action from controller
     */
    private function __construct()
    {
        # get uri
        $uri = $this->parseUrl();
        # controller
        if (file_exists('controllers/' . ucwords($uri['controller']) . '.php')) {
            $this->controller = ucwords($uri['controller']);
        }
        $this->controller = new $this->controller;
        # action / method
        if (!empty(trim($uri['action']))) {
            if (method_exists($this->controller, $uri['action'])) {
                $this->action = $uri['action'];
            }
        }
        # params
        $this->params = $uri['params'];

        # run action from controller with params
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    /**
     * @return array
     */
    private function parseUrl()
    {
        $strUrl = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $arrUrl = explode('/', $strUrl);

        $out = [];
        $out['controller'] = trim(strip_tags($arrUrl[0])) ?? '';
        $out['action'] = trim(strip_tags($arrUrl[1])) ?? '';
        if (count($arrUrl) % 2 == 0 && count($arrUrl) > 2) {
            $k = $v = [];
            for ($i = 2, $cnt = count($arrUrl); $i < $cnt; $i++) {
                if ($i % 2 == 0) {
                    $k[] = $arrUrl[$i];
                } else {
                    $v[] = $arrUrl[$i];
                }
            }
            $out['params'] = array_combine($k, $v);
        } else {
            $out['params'] = [];
        }

        return $out;
    }

    /**
     * @return App
     */
    public static function run()
    {
        if (!(self::$instance instanceOf self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * disable clone
     */
    private function __clone(){}
}
