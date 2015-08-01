<?php

/**
 * Class Home
 * @author: Ivan Vereš
 */

class Home extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::start();
    }

    /**
     *  All routes must have an index() function
     */
    public function index()
    {
        $this->view->ses = $_SESSION;
        return $this->view->render('home/home');
    }
}