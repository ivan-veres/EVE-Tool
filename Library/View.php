<?php

/**
 * Class View
 * @author: Ivan Vere�
 */

class View
{

    public function render($name)
    {
        require_once BASE_PATH . 'Views/' . $name . '.phtml';
    }
}