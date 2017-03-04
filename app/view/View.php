<?php

/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2017-02-13
 * Time: 6:26 PM
 */


class View {
    public function load ($view, $data=null, $data2=null , $header=null, $sidebar=null, $footer=null) {
        if(!is_null($header)) {
            require "templates/".$header.".php";
        } else {
            require "templates/common/header.php";
        }

        if(!is_null($sidebar)) {
            require "templates/".$sidebar.".php";
        }

        require "templates/".$view.".php";

        if(!is_null($footer)) {
            require "templates/".$footer.".php";
        } else {
            require "templates/common/footer.php";
        }

    }

    public function loadWithSidebar ($view, $data=null, $data2=null, $sidebar) {
            require "templates/common/header.php";
            require "templates/".$sidebar.".php";
            require "templates/".$view.".php";
            require "templates/common/footer.php";
    }
}