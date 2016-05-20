<?php
namespace App\Plugins;
use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

use Phalcon\Acl\Role;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;

class SecurityPlugin extends Plugin
{

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the "auth" variable exists in session to define the active role
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            if ($auth->role == 0) {
                $role = 'Users';
            }
            else {
                $role = 'Admin';
            }
        }

        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();

        $action = $dispatcher->getActionName();

        // Obtain the ACL list
        $acl = $this->getAcl();

        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);

        if ($allowed != Acl::ALLOW) {
            $dispatcher->forward(
                array(
                    'controller' => 'platform',
                    'action'     => 'index'
                )
            );
            // Returning "false" we tell to the dispatcher to stop the current operation
            return false;
        }
    }


    public function getAcl() 
    {
        // Create the ACL
        $acl = new AclList();

        // The default action is DENY access
        $acl->setDefaultAction(Acl::DENY);

        // Register two roles, Users is registered users
        // and guests are users without a defined identity
        $roles = array(
            'users'  => new Role('Users'),
            'guests' => new Role('Guests'),
            'admin'  => new Role('Admins'),
        );

        foreach ($roles as $role) {
            $acl->addRole($role);
        }        

        //管理员的权限
        $adminResources = array(
          'platform'  => array('index'),
          'manage'    => array('index', 'getAccont'),
          'account'   => array('delete','update','updateView'),
        );
        foreach ($adminResources as $resource => $actions) {
            $acl->addResource(new Resource($resource), $actions);
        }

        // Public area resources (frontend)
        $userResources = array(
            'platform'  => array('index'),
            'account'   => array('login','loginView','logout'),
            'blog'      =>
                array('index','edit','post','search','aboutMe',
                      'description','deleteBlog','updateBlogView',
                      'setting','siteSetting','siteSettingUpdate',
                      'updateUserView','updateUser',
                ),
        ); 
        $guestResources = array(
            'platform'  => array('index'),
            'account'   => array('login','loginView','registerView',
                                  'register','adminLoginView',
                            ),
            'blog'      => array('index','aboutMe','description',
                                 'search'
                           ), 
        );
        foreach ($guestResources as $resource => $actions) {
            $acl->addResource(new Resource($resource), $actions);
        }

        foreach ($userResources as $resource => $actions) {
            $acl->addResource(new Resource($resource), $actions);
        }

        /*
        // Grant access to public areas to both users and guests
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                $acl->allow($role->getName(), $resource, '*');
            }
        }
        */
        // Grant access to private area only to role Users
        foreach ($userResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('Users', $resource, $action);
            }
        }
        foreach ($guestResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('Guests', $resource, $action);
            }
        }

        return $acl;
    }

}

