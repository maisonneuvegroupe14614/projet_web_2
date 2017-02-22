<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:43 PM
 */


class AdminController extends Controller {
    public function __construct($view) {
        parent::__construct($view);
    }

    public function test () {
        $this->view->load('admin');
    }
}