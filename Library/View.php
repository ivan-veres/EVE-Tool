<?php

/**
 * Class View
 * @author: Ivan Vereš
 */

class View
{

    public function render($name)
    {
        require_once BASE_PATH . 'Views/' . $name . '.phtml';
    }
}