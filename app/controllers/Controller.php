<?php

/**
 * Class Controller
 */
class Controller {
    protected $view;
    protected $request;

    /**
     * Controller constructor.
     * @param $view
     * @param $request
     */
    public function __construct($view,$request) {
       $this->view = $view;
       $this->request = $request;
    }
}