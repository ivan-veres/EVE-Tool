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
    }

    abstract public function index();
}