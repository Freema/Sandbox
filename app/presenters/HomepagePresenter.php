<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
    }

    public function handleCreateDefaultUser()
    {
        $user = new User('admin');
        $user->setPassword($this->getContext()->authenticator->calculateHash('admin'));
        $user->setRole('admin');

        $this->em->persist($user);
        try {
            $this->em->flush();
        } catch(\PDOException $e) {
            dump($e->getMessage());
            $this->terminate();
        }
        
        $this->flashMessage('User create', 'success');
        $this->redirect('default');
    }
}
