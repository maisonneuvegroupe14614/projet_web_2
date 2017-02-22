<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:26 PM
 */


class Controller {
    protected $view;

    public function __construct($view) {
       $this->view = $view;
    }
}