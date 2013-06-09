<?php

include_once 'bootstrap.php';
/**
 * Description of TestCase
 *
 * @author Tomáš
 */

class TestCase extends PHPUnit_Framework_TestCase {
    
    /**
     * 
     * @return \SystemContainer
     */
    public function getContainer()
    {
        return $GLOBALS['container'];
    }
    
    public function getPresenter($name)
    {
        $presenter = $this->getContainer()
                          ->getByType('Nette\Application\IPresenterFactory')
                          ->createPresenter($name);
        
        $presenter->autoCanonicalize = FALSE;
        
        return $presenter;
    }
}