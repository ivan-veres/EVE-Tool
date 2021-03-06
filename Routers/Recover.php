<?php

class Recover extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', '');
    }

    public function index()
    {
    }

    public function password($uid)
    {
        try {
            $user = $this->db->query('SELECT id FROM users WHERE recover = :uid',
                array(
                    'uid' => $uid
                ));
            if (!$user >= 1) {
                $this->redirect('/');
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $this->view->uid = $uid;

        $this->view->render('recover/password');
    }

    public function reset()
    {
        $this->validate = new Validate();

        if (isset($_POST) && $this->validate->isValidPassword($_POST['password'])) {

            $uid = $_POST['uid'];
            $password = $_POST['password'];

            try {
                $this->user = $this->db->query('SELECT * FROM users WHERE recover = :uid',
                    array(
                        'uid' => $uid
                    ));

                if (null != $this->user) {
                    $this->db->insert('UPDATE users SET password = :pass, recover = NULL WHERE id = :id',
                        array(
                            'id' => $this->user['id'],
                            'pass' => md5($this->user['username'] . $password)
                        ));
                }
            } catch (PDOException $e) {
                die($e->getMessage());
            }

            Session::flash('success', 'Password successfully changed!!');
            return $this->redirect('/login');
        }

        Session::flash('bad', 'Something went wrong! Please try again!');
        return $this->redirect('/');
    }
}