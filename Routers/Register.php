<?php


class Register extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', '');
    }

    public function index()
    {
        $this->view->render('register/register');
    }

    public function submit()
    {
        $this->validate = new Validate;

        if (!$this->validate->isValid($_POST) || !$this->validate->isValidEmail($_POST))
            header('Location: /register');

        $this->email = $_POST['email'];
        $this->username = strtolower($_POST['username']);
        $this->password = $_POST['password'];


        try {
            $this->db->insert('INSERT INTO users(email, username, password) VALUES (:email, :name, :pass)', array(
                'email' => $this->email,
                'name'  => $this->username,
                'pass'  => md5($this->username.$this->password)
            ));
        }  catch(PDOException $e) {
            die($e->getMessage());
        }

        $this->redirect('/login');

    }
}