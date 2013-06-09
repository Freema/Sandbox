<?php

include_once '/../../TestCase.php';

class HomepagePresenterTests extends TestCase
{
    public function testRenderDefault()
    {
        /* @var $presenter HomepagePresenter */
        $presenter = $this->getPresenter('Homepage');
        
        $request = new Nette\Application\Request('Homepage', 'GET', array(
            'action'  => 'default'
            ));
        $response = $presenter->run($request);
        
        $this->assertInstanceOf('Nette\Application\Responses\TextResponse', $response);
    }
}
