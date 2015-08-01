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
        Session::set('active', 'home');
    }

    /**
     *  All routes must have an index() function
     */
    public function index()
    {
        $this->view->ses = $_SESSION;
        $this->view->md5 = strlen(hash('sha256', 'ivan' .  time()));
        return $this->view->render('home/home');
    }
}