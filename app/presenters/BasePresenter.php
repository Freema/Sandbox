<?php

use Doctrine\ORM\EntityManager;
use Nette\InvalidStateException;

/**
 * Base class for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var Doctrine\ORM\EntityManager */
    protected $em;

    public function injectEntityManager(EntityManager $em)
    {
        if ($this->em) {
                throw new InvalidStateException('Entity manager has already been set');
        }
        $this->em = $em;
        return $this;
    }
}
