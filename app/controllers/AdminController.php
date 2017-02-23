<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:43 PM
 */


class AdminController extends Controller {
    public function __construct($view,$request) {
        parent::__construct($view,$request);
    }

    public function test () {
        $this->view->load('admin');
    }
}