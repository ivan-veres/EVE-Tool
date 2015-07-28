<?php

/**
 * Class Login
 * @author: Ivan Vereš
 */

class Login extends Route
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('login/login');
    }

    public function submit()
    {
        $this->validate = new Validate;

        if ($this->validate->isValid($_POST)) {
            $this->username = $_POST['username'];
            $this->password = $_POST['password'];
        }

        $this->view->submit = md5($this->username.$this->password);
        $this->view->render('login/submit');
    }
}