<?php


class PDOConnection extends  PDO
{

    public function __construct($dsn, $username = null, $password = null, array $options = null)
    {
        try {
            parent::__construct($dsn, $username, $password, $options);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}