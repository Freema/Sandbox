<?php

include_once '/../../TestCase.php';

class SignPresenterTest extends TestCase 
{

    public function testRenderIn()
    {
        /* @var $presenter SignPresenter */
        $presenter = $this->getPresenter('Sign');
        
        $request = new Nette\Application\Request('Sign', 'GET', array(
            'action'  => 'in'
            ));
        $response = $presenter->run($request);
        
        $this->assertInstanceOf('Nette\Application\Responses\TextResponse', $response);
    }
    
    public function testRenderForm()
    {
        /* @var $presenter SignPresenter */
        $presenter = $this->getPresenter('Sign');
        
        $request = new Nette\Application\Request('Sign', 'GET', array(
            'action'  => 'in'
            ));
        $response = $presenter->run($request);
        
        $login_form = $response->getSource()->presenter['signInForm'];
        $this->assertInstanceOf('Nette\Application\UI\Form', $login_form);          
    }
    
    public function testSignInFormIsEmpty()
    {
        /* @var $presenter SignPresenter */
        $presenter = $this->getPresenter('Sign');
        
        $request = new Nette\Application\Request('Sign', 'POST', array(
                'action'    => 'in',
                'do'        => 'signInForm-submit',
            ), array(
                'username'  => '',
                'password'  => '',
                'remember'  => TRUE,
                'send'      => 'Send',
            ));
        $response = $presenter->run($request);
        
        $this->assertInstanceOf('Nette\Application\Responses\TextResponse', $response);
        $template = $response->getSource();
        $this->assertTrue($template->presenter['signInForm']->hasErrors());
    }
    
    
    public function testLoginIn()
    {
        /* @var $presenter SignPresenter */
        $presenter = $this->getPresenter('Sign');
        
        $request = new Nette\Application\Request('Sign', 'POST', array(
                'action'    => 'in',
                'do'        => 'signInForm-submit',
            ), array(
                'username'  => 'admin',
                'password'  => 'admin',
                'remember'  => TRUE,
                'send'      => 'Send',
            ));
        
        $this->getContainer()->user->logout();
        $response = $presenter->run($request);
        
        $this->assertTrue($this->getContainer()->user->isLoggedIn());
        $this->assertInstanceOf('Nette\Application\Responses\RedirectResponse', $response);
    }
}
