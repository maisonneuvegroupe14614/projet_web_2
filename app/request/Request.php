<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017-02-23
 * Time: 11:04 AM
 */

/**
 * Class Request
 */
class Request {
    private $param;

    /**
     * Request constructor.
     */
    public function __construct() {
        $url = $_SERVER['REQUEST_URI'];

        $url = explode('/',$url);

        if(isset($url[4]) && !empty($url[4])){
            $this->param = $url[4];
        }

    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @param mixed $param
     * @return Request
     */
    public function setParam($param)
    {
        $this->param = $param;
        return $this;
    }


}