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
        $this->db   = new Database();
    }

    abstract public function index();
}