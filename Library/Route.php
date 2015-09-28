<?php


/**
 * Abstract Class Route
 * @author: Ivan Vereš
 */

abstract class Route
{

    public function __construct()
    {
        Session::start();
        $this->view = new View();
        $this->db   = Database::getInstance();
    }

    abstract public function index();

    public function redirect($location)
    {
        if (!isset($location)) {
            return;
        }

        header('Location: ' . $location);
    }
}