<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:26 PM
 */


class Controller {
    protected $view;
    protected $request;

    public function __construct($view,$request) {
       $this->view = $view;
       $this->request = $request;
    }
}