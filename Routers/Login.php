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

        //if ($this->validate->isValid($_POST)) {
            $this->username = $_POST['username'];
            $this->password = $_POST['password'];
        //}

        try {
            $this->user = $this->db->query('SELECT * FROM users WHERE username = :username', array('username' => $this->username));

            if ($this->user['password'] . ' ??? ' . md5($this->username . $this->password)) {
                header('Location: http://ind2.dev', flase);
            }


        } catch(Exception $e) {

        }
        $this->view->render('login/submit');
    }
}