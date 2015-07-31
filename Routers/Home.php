<?php

/**
 * Class Home
 * @author: Ivan Vereš
 */

class Home extends Route
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  All routes must have an index() function
     */
    public function index()
    {

        $this->db->query('INSERT INTO users (email, username, password, role, last_login) VALUES (:email, :name, :pass, :role, :last)',
            array(
                'email' => 'sima@ind2.dev',
                'name'  => 'sima',
                'pass'  => md5('annaosk'.'dragonball'),
                'role'  => 'admin',
                'last'  => date("Y-m-d H:i:s"),
            ));

        $this->view->user = $this->db->query('SELECT * FROM users', '');
        $this->view->username = $this->view->user['username'];

        $this->view->render('home/home');
    }
}