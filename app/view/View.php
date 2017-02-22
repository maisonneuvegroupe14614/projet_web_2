<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:26 PM
 */


class View {
    public function load ($view, $data=null) {
        require "templates/common/header.php";
        require "templates/".$view.".php";
        require "templates/common/footer.php";
    }
}