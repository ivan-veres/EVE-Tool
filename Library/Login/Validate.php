<?php

class Validate
{

    public function isValid($post)
    {
        $valid = false;

        if (!empty($post)) {

            if (array_key_exists('username', $post)) {

                $username = $post['username'];

                // Username must be 3-12 characters long and should contain a-z, 0-9 and underscore '_'
                if (!preg_match('/^[a-z\d_]{3,12}$/i', $username)) {
                    return false;
                }
                $valid = true;
            }

            if (array_key_exists('password', $post)) {

                $password = $post['password'];

                // password must be 4-12 characters long and should contain a-z, 0-9, !, #, $, %
                if (!preg_match('/^[a-z\d!@#$%]{4,12}$/i', $password)) {
                    return false;
                }
                $valid = true;
            }
        }
        return $valid;
    }

    public function isValidEmail($post)
    {
        if (!empty($post)) {

            if (array_key_exists('email', $post)) {

                $this->email = $_POST['email'];

                if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function isValidPassword($password)
    {
        if (!empty($password)) {
            if (preg_match('/^[a-z\d!@#$%]{4,12}$/i', $password)) {
                return true;
            }
        }
        return false;

    }
}