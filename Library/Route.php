<?php


/**
 * Abstract Class Route
 * @author: Ivan Vereš
 */

abstract class Route
{

    public function __construct()
    {
        $this->view = new View();
        $this->db   = Database::getInstance();
    }

    abstract public function index();
}