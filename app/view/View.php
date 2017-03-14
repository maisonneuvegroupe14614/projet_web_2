<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:26 PM
 */


class View {
    public function load ($view, $data=null, $data2=null , $sidebar=null) {
        if(is_null($sidebar)) {
            require "templates/common/header.php";
            require "templates/".$view.".php";
            require "templates/common/footer.php";
        } else {
            require "templates/common/header.php";
            require "templates/common/".$sidebar.".php";
            require "templates/".$view.".php";
            require "templates/common/footer.php";
        }

    }

}