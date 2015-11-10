<?php

/**
 * Class Home
 * @author: Ivan Veres
 */

class Home extends Route
{

    public function __construct()
    {
        parent::__construct();
        Session::set('active', 'home');
    }

    /**
     *  All routes must have an index() function
     */
    public function index()
    {
        $this->view->loggedIn       = @Session::get('user') ? true : false;
        $this->view->accountName    = $this->helper->getCharacterName();
        $this->view->portraitPath   = $this->helper->getPortraitImage();
        $this->view->apiInformation = $this->helper->getApiInformation();
        return $this->view->render('home/home');
    }
}