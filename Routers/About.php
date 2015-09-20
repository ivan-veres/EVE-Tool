<?php


class About extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', 'about');
    }

    public function index()
    {
        $this->view->render('about/about');
    }
}