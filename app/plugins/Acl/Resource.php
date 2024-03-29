<?php

namespace Hrcontacts\Plugins\Acl;

use Hrcontacts\Plugins\Acl\Resource\ResourceInterface;

class Resource implements ResourceInterface
{
    private $privateResources = [
        'contacts'    => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
        'profile'      => ['edit']
    ];

    private $publicResources = [
        'index'      => ['index'],
        'about'      => ['index'],
        'register'   => ['index'],
        'errors'     => ['show401', 'show404', 'show500'],
        'session'    => ['index', 'register', 'start', 'end', 'acdone'],
    ];

    private $allResources;

    public function getPrivateResources()
    {
        return $this->privateResources;
    }

    public function getPublicResources()
    {
        return $this->publicResources;
    }

    public function hasResource($name)
    {
        $allResources = $this->getAllResources();

        return isset($allResources[$name]);
    }

    public function hasAccess($resource, $access)
    {
        $allResources = $this->getAllResources();

        return isset($allResources[$resource]) && in_array($access, $allResources[$resource]);
    }

    public function getAllResources()
    {
        if (!empty($this->allResources)) {
            return $this->allResources;
        }

        $allResources = [];

        foreach ($this->privateResources as $resource => $accessList) {
            if (!is_array($accessList)) {
                $accessList = [$accessList];
            }

            if (!isset($allResources[$resource])) {
                $allResources[$resource] = [];
            }

            $allResources[$resource] = array_merge($allResources[$resource], $accessList);
        }

        foreach ($this->publicResources as $resource => $accessList) {
            if (!is_array($accessList)) {
                $accessList = [$accessList];
            }

            if (!isset($allResources[$resource])) {
                $allResources[$resource] = [];
            }

            $allResources[$resource] = array_merge($allResources[$resource], $accessList);
        }

        $this->allResources = $allResources;

        return $allResources;
    }
}
