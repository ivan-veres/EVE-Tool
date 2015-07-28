<?php

/**
 * Class View
 * @author: Ivan Vereš
 */

class View
{

    protected $_html;

    /**
     *  Requires template located at Views/Template.phtml
     */
    public function renderTemplate()
    {
        if(file_exists(BASE_PATH . 'Views/Template.phtml'))
            require_once BASE_PATH . 'Views/Template.phtml';
    }

    /**
     * Renders the template file and router associated view
     * @param $name
     */
    public function render($name)
    {
        if(file_exists(BASE_PATH . 'Views/' . $name . '.phtml'))
        {
            ob_start();
            require_once BASE_PATH . 'Views/' . $name . '.phtml';
            $this->_html = ob_get_clean();
            return $this->renderTemplate();
        }
    }
}