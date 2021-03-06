<?php

/**
 * Class Login
 * @author: Ivan Vere�
 */

class Login extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', 'login');

        if ( null != @Session::get('user')) {
            $this->redirect('/');
        }
    }

    public function index()
    {
        $this->view->ses = $_SESSION;
        $this->view->render('login/login');
    }

    public function submit()
    {
        $this->validate = new Validate;

        if (!$this->validate->isValid($_POST))
            $this->redirect('/login');

        $this->username = $_POST['username'];
        $this->password = $_POST['password'];

        try {
            $this->user = $this->db->query('SELECT * FROM users WHERE username = :username',
                array('username' => $this->username));

            if ($this->user['password'] === md5($this->username . $this->password)) {
                Session::start();
                Session::set('id', $this->user['id']);
                Session::set('user', $this->user['username']);
                Session::set('role', $this->user['role']);

                $this->db->insert('UPDATE users SET last_login = :last WHERE id = :id', array(
                    'last' => date('Y-m-d H:i:s', time()),
                    'id' => $this->user['id']
                ));
                $this->redirect('/');
            } else {
                Session::flash('bad', 'Wrong credentials!!');
                $this->redirect('/login');
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function logout()
    {
        Session::destroy();

        $this->redirect('/');
    }

    public function forgot()
    {
        if (!empty($_POST)) {
            try {
                $email = $_POST['email'];
                $this->user = $this->db->query('SELECT id FROM users WHERE email = :email', array('email' => $email));
                var_dump($this->user);
                if ($this->user['id'] != false) {
                    $hash = hash('sha256', $email . time());
                    $this->db->insert('UPDATE users SET recover = :hash WHERE id = :id',
                        array(
                            'hash' => $hash,
                            'id' => $this->user['id']));

                    mail($email, 'Password recovery', "To reset your password visit this link: http://" . BASE_URL . "/recover/password/$hash");

                    Session::flash('success', 'Link to reset your password has been sent!');
                    return $this->redirect('/login');
                } else {
                    Session::flash('bad', 'Email You specified does not exist in our system.');
                    return $this->redirect('/login/forgot');
                }

            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        $this->view->post = $_POST;
        $this->view->render('login/forgot');
    }
}