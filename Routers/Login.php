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
        Session::start();
        Session::set('active', 'login');
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        $this->view->ses = $_SESSION;
        $this->view->render('login/login');
    }

    public function submit()
    {
        $this->validate = new Validate;

        if (!$this->validate->isValid($_POST))
            header('Location: /login');

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];

        try {
            $this->user = $this->db->query('SELECT * FROM users WHERE username = :username', array('username' => $this->username));

            if ($this->user['password'] === md5($this->username . $this->password)) {
                Session::start();
                Session::set('user', $this->user['username']);
                Session::set('role', $this->user['role']);

                $this->db->insert('UPDATE users SET last_login = :last WHERE id = :id', array(
                    'last' => date('Y-m-d H:i:s', time()),
                    'id' => $this->user['id']
                ));
                header('Location: /');
            } else {
                header('Location: /login');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function logout()
    {
        Session::destroy();

        header('Location: /');
    }
}