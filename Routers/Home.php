<?php

class Home extends Route
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->msg = 'Hello World!';
        $this->view->render('home');
    }
}