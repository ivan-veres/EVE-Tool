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

    public function forgot()
    {
        if (!empty($_POST)) {
            try {
                $hash = hash('sha256', $_POST['email'] . time());
                $this->user = $this->db->query('SELECT id FROM users WHERE email = :email', array('email' => $_POST['email']));
                if (null != $this->user['id']) {
                    $this->db->insert('UPDATE users SET recover = :hash WHERE id = :id',
                        array(
                            'hash' => $hash,
                            'id' => $this->user['id']));

                    mail($_POST['email'], 'Password recovery', "To reset your password visit this link: http://ind2.dev/recover/password/$hash");
                } else {
                    header('Location: /login/forgot');
                }

                // TODO: Flash message = Link to reset your password has been sent
            } catch (Exception $e) {
                die($e->getMessage());
            }
            //mail($_POST['email'], 'Password', '');
        }

        $this->view->render('login/forgot');
    }
}