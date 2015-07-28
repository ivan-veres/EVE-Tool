<?php

/**
 * Class Router
 * @author: Ivan Vereš
 */

class Router
{

    protected $_url = array();
    protected $_action = array();
    protected $_router = 'home';
    protected $_method = 'index';
    protected $_params = array();


    /**
     * @param $url
     * @param null $action
     */
    public function add($url, $action)
    {
        $this->_url[] = $url;
        if (null !== $action) {
            $this->_action[] = $action;
        }
    }

    /**
     * URL parsing
     * Calls corresponding router and action
     */
    public function dispatch()
    {
        // Add starting slash, trim leading slash
        $url = isset($_GET['url']) ? '/' . rtrim($_GET['url'], '/') : '/' ;
        if (isset($_GET['url'])) {
            $this->_params = explode('/', $_GET['url'])[2] ? explode('/', $_GET['url'])[2] : array();
        }
        foreach ($this->_url as $key => $value) {
            if (preg_match("#^$value$#", $url)) {

                // Finds router and action
                $action = explode('#', $this->_action[$key]);
                $this->_router = $action[0];
                $this->_method = $action[1];

                // Calls corresponding router and action with params
                if(file_exists(BASE_PATH . 'Routers/' . $this->_router . '.php')) {
                    $this->_router = new $this->_router;
                    if (method_exists($this->_router, $this->_method)) {
                        call_user_func_array(array($this->_router, $this->_method), $this->_params);
                    }
                }
            }
        }
    }
}