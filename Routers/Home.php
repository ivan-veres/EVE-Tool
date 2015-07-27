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
    }

    /**
     *  All routes must have an index() function
     */
    public function index()
    {
        $this->view->msg = 'Home/Index';
        $this->view->render('home');
    }
}