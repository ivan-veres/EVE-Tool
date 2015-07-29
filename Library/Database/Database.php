<?php

class Database
{

    public function __construct()
    {

    }


    public function connect(array $params, $username = null, $password = null, array $options = array())
    {
        try {
            $dbh = new PDOConnection(
                $this->constructDsn($params),
                $username,
                $password,
                $options
            );
        } catch (PDOException $e) {
            new PDOException($e);
        }
        return $dbh;
    }

    public function constructDsn(array $params)
    {
        $dsn = 'mysql:';
        if (isset($params['host']) && $params['host'] != '') {
            $dsn .= $params['host'] . ';';
        }
        if (isset($params['dbname']) && $params['dbname'] != '') {
            $dsn .= $params['dbname'] . ';';
        }
        if (isset($params['charset']) && $params['charset'] != '') {
            $dsn .= $params['charset'] . ';';
        }

        return $dsn;
    }
}