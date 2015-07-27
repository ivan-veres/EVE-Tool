<?php

/**
 * Class Home
 * @author: Ivan Vere�
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
        $this->view->render('home');
    }
}