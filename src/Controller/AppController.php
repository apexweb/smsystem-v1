<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */


    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display', 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display', 'home'
            ]
        ]);

        if ($this->Auth->user()) {
            $this->viewBuilder()->layout('pantherpro-in');
        } else {
            $this->viewBuilder()->layout('pantherpro-out');
        }


    }


    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['view', 'display', 'register', 'logout']);

//        $users = TableRegistry::get('users'); //load model User
//        if ($this->Auth->user()) {
//            $this->set('avatar', $users->get($this->Auth->user('id'))->profilePicture);
//        }

        $this->set('authUser', $this->Auth->user());
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);


        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        //Default deny
        return false;
    }

    public function authorize($roles)
    {
        $isAuthorized = false;
        $currentUserRole = $this->Auth->user('role');

        // Admin can access every action
        if ($currentUserRole != 'admin') {
            foreach ($roles as $role) {
                if ($role == $currentUserRole) {
                    $isAuthorized = true;
                    break;
                }
            }

            //if isAuthorized it will do anything, but if it isn't it will redirect to home page with error msg
            if (!$isAuthorized) {
                $this->Flash->error(__('You are not authorized to view this page.'));
                return $this->redirect('/');
            }
        }
        return true;
    }


    public function authorizeByModel($model)
    {
        if ($model->user_id != $this->Auth->user('id')) {
            $this->Flash->error(__('You are not authorized to view this page.'));
            return $this->redirect('/');
        }
        return true;
    }


    protected function sendEmail($recievers, $type, $model = null)
    {
        if (empty($recievers)) {
            return false;
        }

        try {

            $email = new Email();

            if (is_array($recievers)) {
                foreach ($recievers as $reciever) {
                    $email->addTo($reciever);
                }
            } else {
                $email->addTo($recievers);
            }

            $email->template($type);
            $email->emailFormat('html');


            switch ($type) {
                case 'mf_order_placed':
                    $email->subject('New Order Received!');
                    $email->viewVars(['quote' => $model]);
                    break;
                case 'customer_order_placed':
                    $email->subject('Order is placed!');
                    $email->viewVars(['quote' => $model]);
                    break;
                case 'customer_order_completed':
                    $email->subject('Job Completion Notification');
                    $email->viewVars(['quote' => $model]);
                    break;
                case 'installer_order_placed':
                    $email->subject('Installing Required! A New Order Received!');
                    $email->viewVars(['quote' => $model]);
                    break;
                case 'new_user':
                    $email->subject('Welcome to SMS');
                    $email->viewVars(['user' => $model]);
                    break;
                case 'mf_attachment':
                    $email->attachments([$model->attachment]);
                    $email->subject('SMS - ' . $model->business_name . ' - ' . $model->customer_name . ' - ' . $model->qId);
                    $email->viewVars(['quote' => $model]);
                    break;
            }

            $email->send();
            return true;
        } catch (Exception $e) {
            //TODO need some Logging
            return false;
        }
    }
}
