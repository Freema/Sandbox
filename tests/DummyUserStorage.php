<?php

use Nette\Security\IIdentity;
use Nette\Security\IUserStorage;

/**
 * Description of DummyUserStorage
 *
 * @author Tomáš Grasl
 */
class DummyUserStorage implements IUserStorage
{

    private $authenticated;

    private $identity;

    public function setAuthenticated($state)
    {
        $this->authenticated = $state;
    }

    public function isAuthenticated()
    {
        return $this->authenticated;
    }

    public function setIdentity(IIdentity $identity = NULL)
    {
        $this->identity = $identity;
    }

    public function getIdentity()
    {
        return $this->identity;
    }

    public function setExpiration($time, $flags = 0)
    {
       
    }

    public function getLogoutReason()
    {
        return NULL;
    }

}