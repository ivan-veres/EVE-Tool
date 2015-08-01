<?php

class Recover extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::start();
        Session::set('active', '');
    }

    public function index()
    {
        $this->view->get = $_GET;

        $this->view->render('recover/password');
    }

    public function password()
    {
        $this->view->get = $_GET;

        $this->view->render('recover/password');
    }
}