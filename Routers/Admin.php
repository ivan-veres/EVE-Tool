<?php

/**
 * Class Admin
 * @author: Ivan Vere�
 */

class Admin extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', 'admin');
    }

    public function index()
    {
        $this->view->render('admin/admin');
    }
}