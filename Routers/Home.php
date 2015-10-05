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
        Session::set('active', 'home');
    }

    /**
     *  All routes must have an index() function
     */
    public function index()
    {
        $this->view->ses = $_SESSION;
        $this->view->md5 = md5('admin'.'testing');
        return $this->view->render('home/home');
    }
}