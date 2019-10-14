<?php

namespace Hrcontacts\Library;

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    private $headerMenu = [
        'public' => [
            'index' => [
                'caption' => 'Home',
                'action' => 'index'
            ],
            'contacts' => [
                'caption' => 'Dashboard',
                'action' => 'index'
            ],
            'about' => [
                'caption' => 'About',
                'action' => 'index'
            ],
        ],
        'logins' => [
            'session' => [
                'caption' => 'Account',
                'action' => 'index'
            ],
        ]
    ];
    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {
        $auth = $this->session->get('auth');
        if (isset($auth['id'])) {
            $this->headerMenu['logins'] = [
                'profile' => [
                    'caption' => 'Profile',
                    'action'  => 'edit'
                ],
                'session' => [
                    'caption' => 'Log Out',
                    'action' => 'end'
                ]
            ];
        } else {
            unset($this->headerMenu['dashboard']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->headerMenu as $position => $menu) {
            echo '<ul class="navbar-nav ml-auto ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="nav-item active">';
                } else {
                    echo '<li class="nav-item">';
                }

                $link = $controller . '/' . $option['action'];

                if (isset($option['params'])) {
                    $link .= '/' . $option['params'];
                }

                echo $this->tag->linkTo(array($link, $option['caption'], "class" => "nav-link", "name" => $option['caption'] ) );
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}
