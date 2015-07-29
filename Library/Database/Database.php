<?php

class Database extends PDO
{

    private $_isConnected = false;
    private $_params = array();
    private $_username;
    private $_password;

    protected $_pdo;
    protected static $_instance;

    public function __construct()
    {
        $this->_params['host'] = DB_HOST;
        $this->_params['database'] = DB_NAME;
        $this->_params['charset'] = DB_CHARSET;
        $this->_username = DB_USER;
        $this->_password = DB_PASSWORD;
    }


    public function connect(array $params, $username = null, $password = null, array $options = array())
    {
        if (!$this->_isConnected) {

            try {
                $this->_pdo = new PDO(
                    $this->constructDsn($params),
                    $username,
                    $password,
                    $options);
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->_isConnected = true;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return $this->_pdo;
    }

    public function constructDsn(array $params)
    {
        $dsn = 'mysql:';
        if (isset($params['host']) && $params['host'] != '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }
        if (isset($params['database']) && $params['database'] != '') {
            $dsn .= 'dbname=' . $params['database'] . ';';
        }
        if (isset($params['charset']) && $params['charset'] != '') {
            $dsn .= 'charset=' . $params['charset'] . ';';
        }
        return $dsn;

    }

    public function query($sql, $params)
    {
        $this->connect($this->_params, $this->_username, $this->_password);

        $sth = $this->_pdo->prepare($sql);

        $params = is_array($params) ? $params : [$params];

        try {
            $sth->execute($params);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }


}