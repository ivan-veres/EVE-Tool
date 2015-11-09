<?php

/**
 * Class Helper
 * @author: Ivan Vereš
 */

class Helper
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getCharacterName()
    {
        if(isset($_SESSION['id'])) {
            $characterName = $this->db->query('SELECT character_name FROM characters WHERE user_id = :user_id',
                array(
                    'user_id' => $_SESSION['id']
                )
            );
            return $characterName['character_name'];
        }
        return false;
    }

    public function PortraitFromEveOnline($characterID)
    {
        return file_get_contents('http://image.eveonline.com/Character/'. $characterID . '_256.jpg');
    }

    public function getPortraitImage()
    {
        if(isset($_SESSION['id'])) {
            $image = $this->db->query('SELECT character_portrait FROM characters WHERE user_id = :user_id',
                array(
                    'user_id' => $_SESSION['id']
                )
            );

            if(file_exists($image['character_portrait'])) {
                return $image['character_portrait'];
            }
        }
        return false;
    }

    public function getApiInformation()
    {
        if(isset($_SESSION['id'])) {
            $apiInformation = $this->db->query('SELECT keyid, verification_code FROM user_api WHERE user_id = :user_id',
                array(
                    'user_id' => $_SESSION['id']
                )
            );
            return $apiInformation;
        }
        return false;
    }
}