<?php
/**
 * Created by PhpStorm.
 * User: APG
 * Date: 10.06.2020
 * Time: 17:32
 */

class Controller
{
    public function model($model)
    {
        try {
            return new $model;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function view($view, array $data = [])
    {
        try {
            return new view;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
