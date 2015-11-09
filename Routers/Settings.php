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

        $characterID = $_POST['characterId'];
        $characterName = $_POST['characterName'];


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
            $this->db->insert('UPDATE characters SET character_id = :charID, character_name = :charName WHERE user_id = :user_id',
                array(
                    'charID'    => $characterID,
                    'charName'  => $characterName,
                    'user_id'   => $user_id
                ));
        } else {
            $this->db->insert('INSERT INTO user_api(user_id, keyid, verification_code) VALUES (:user_id, :keyid, :verificationCode)',
                array(
                    'user_id'           => $user_id,
                    'keyid'             => $keyID,
                    'verificationCode'  => $verificationCode
                ));
            $this->db->insert('INSERT INTO characters(user_id, character_id, character_name) VALUES (:user_id, :charID, :charName)',
                array(
                    'user_id'   => $user_id,
                    'charID'    => $characterID,
                    'charName'  => $characterName
                ));
        }


        $path = 'cache/' . $characterName . '.jpg';
        file_put_contents($path , $this->helper->PortraitFromEveOnline($characterID));

        try {
            $this->db->insert('UPDATE characters SET character_portrait = :portrait_path WHERE user_id = :user_id',
                array(
                    'user_id'       => $user_id,
                    'portrait_path' => $path
                ));
        } catch (Exception $e) {
            $e->getMessage();
        }

        Session::flash('success', 'Successfully added / modified api key!');
        $this->redirect('/settings');
    }
}