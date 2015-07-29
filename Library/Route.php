<?php


/**
 * Abstract Class Route
 * @author: Ivan Vere�
 */

abstract class Route
{

    public function __construct()
    {
        $this->view = new View();
        $this->db   = new Database();
    }

    abstract public function index();
}