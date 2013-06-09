<?php

use Nette\Application\UI;
use Nette\Security as NS;


/**
 * Sign in/out presenters.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class SignPresenter extends BasePresenter
{

    /**
     * Sign in form component factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignInForm()
    {
        $form = new UI\Form;
        $form->addText('username', 'Username:')
             ->addRule(UI\Form::FILLED, 'Please provide a username.');

        $form->addPassword('password', 'Password:')
             ->addRule(UI\Form::FILLED, 'Please provide a password.');

        $form->addCheckbox('remember', 'Remember me on this computer');

        $form->addSubmit('send', 'Sign in');

        $form->onSuccess[] = callback($this, 'signInFormSubmitted');
        return $form;
    }



    public function signInFormSubmitted(UI\Form $form)
    {
        try {
                $values = $form->getValues();
                if ($values->remember) {
                        $this->getUser()->setExpiration('+ 14 days', FALSE);
                } else {
                        $this->getUser()->setExpiration('+ 20 minutes', TRUE);
                }
                $this->getUser()->login($values->username, $values->password);
                $this->redirect('Homepage:dafault');

        } catch (NS\AuthenticationException $e) {
                $form->addError($e->getMessage());
        }
    }



    public function actionOut()
    {
            $this->getUser()->logout();
            $this->flashMessage('You have been signed out.');
            $this->redirect('in');
    }

}
