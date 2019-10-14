<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->tag->prependTitle('HR CONTACTS | ');
        $this->view->setTemplateAfter('main');
    }

}
