<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->tag->prependTitle('HR CONTACTS | ');
        $this->view->setTemplateAfter('main');
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward([
            'controller' => $uriParts[0],
            'action' => $uriParts[1],
            'params' => $params
        ]);
    }

}
