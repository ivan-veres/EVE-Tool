<?php

class Validate
{

    public function isValid($post)
    {
        $valid = false;

        if (!empty($post)) {

            if (array_key_exists('username', $post)) {

                $this->username = $post['username'];

                // Username must be 3-12 characters long and should contain a-z, 0-9 and underscore '_'
                if (!preg_match('/^[a-z\d_]{3,12}$/i', $this->username)) {
                    return false;
                }
                $valid = true;
            }
            
            if (array_key_exists('password', $post)) {

                $this->password = $post['password'];

                // password must be 4-12 characters long and should contain a-z, 0-9, !, #, $, %
                if (!preg_match('/^[a-z\d!@#$%]{4,12}$/i', $this->password)) {
                    return false;
                }
                $valid = true;
            }
        }
        return $valid;
    }
}