<?php


class Settings extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', 'settings');
    }

    public function index()
    {
        try {
            $userID = $_SESSION['id'];

            $api = $this->db->query('SELECT keyid, verification_code FROM user_api WHERE user_id = :userid',
                array(
                 'userid' => $userID
                ));

            $this->view->keyID = $api['keyid'];
            $this->view->verificationCode = $api['verification_code'];
        } catch(Exception $e) {
            die($e->getMessage());
        }

        $this->view->render('settings/settings');
    }

    public function save()
    {
        $keyID = $_POST['keyid'];
        $verificationCode = $_POST['verCode'];
        $user_id = $_SESSION['id'];

        $query = $this->db->query('SELECT id FROM user_api WHERE keyid = :keyid OR verification_code = :verificationCode',
            array(
                'keyid' => $keyID,
                'verificationCode' => $verificationCode
        ));

        if ($query) {
           $this->db->insert('UPDATE user_api SET keyid = :keyid, verification_code = :verificationCode WHERE user_id = :user_id',
               array(
                   'keyid'              => $keyID,
                   'verificationCode'   => $verificationCode,
                   'user_id'            => $user_id
               ));
        } else {
            $this->db->insert('INSERT INTO user_api(user_id, keyid, verification_code) VALUES (:user_id, :keyid, :verificationCode)',
                array(
                    'user_id'           => $user_id,
                    'keyid'             => $keyID,
                    'verificationCode'  => $verificationCode
                ));
        }

        // TODO: Flash msg = Successfully added / modified api key!

        $this->redirect('/settings');
    }
}