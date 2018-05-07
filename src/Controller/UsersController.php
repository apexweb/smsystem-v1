<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\ORM\Behavior\ad;
use Symfony\Component\Config\Definition\Exception\Exception;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['manufacturers', 'addManufacturer', 'delete', 'edit', 'index', 'add', 'copyallpartstomf']);
    }


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cookie'); // Include the FlashComponent

    }

    /*********************************Start-index************************************/

    public function index()
    {
        $this->authorize(['admin', 'supplier']);

        $users = null;
        if ($this->Auth->user('role') == 'admin') {
            $users = $this->paginate($this->Users, ['fields' => ['id', 'created', 'username', 'business_name', 'business_abrev', 'role', 'system_platform', 'modified', 'email', 'parentusername', 'monthly_fee_report'],
                'limit' => 20,
                'order' => [
                    'Users.created' => 'DESC'
                ]]);
        } else {
            $users = $this->paginate($this->Users->find('all')
                ->where(['role IN' => ['distributer', 'wholesaler', 'retailer', 'installer', 'candidate']]),
                ['fields' => ['id', 'created', 'username', 'business_name', 'business_abrev', 'role', 'system_platform', 'modified', 'email', 'parentusername', 'monthly_fee_report'],
                    'limit' => 20,
                    'order' => [
                        'Users.created' => 'DESC'
                    ]]);
        }


        $this->set('users', $users);
    }



    /*********************************End-index************************************/

    /*********************************Start-manufacturers************************************/

    public function manufacturers()
    {
        $this->authorize(['supplier']);
        $users = $this->paginate($this->Users->findAllByRole('manufacturer')->where(['Users.parent_id' => $this->Auth->user('id')]),
            ['fields' => ['id', 'created', 'username', 'role', 'modified', 'email'],
                'limit' => 20,
                'order' => [
                    'Users.created' => 'DESC'
                ],
            ]);

        $this->set('users', $users);
    }

    /*********************************End-manufacturers************************************/

    /*********************************Start-view************************************/
    public function view($id)
    {
        $role = $this->Auth->user('role');
        if ($role == 'supplier') {
            $user = $this->Users->get($id);
            $this->set(compact('user'));
        } else {
            $this->Flash->error(__('You are not authorized to view this page.'));
            return $this->redirect('/');

        }
    }

    /*********************************End-view************************************/

    /*********************************Start-register************************************/
    public function register()
    {
        $this->viewBuilder()->layout('pantherpro-register');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['role'] = 'candidate';
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->sendEmail($user->email, 'new_user', $user);
                $this->Flash->success(__('Registration successful, Welcome to SMS Screen Management System :)'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to register, Please try again.'));
        }
        $this->set('user', $user);
    }
    /*********************************End-register************************************/
    /*********************************Start-add************************************/


    public function add()
    {
        $this->authorize(['admin', 'supplier']);
        $role = $this->Auth->user('role');

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($role == 'supplier') {
                if ($user->role == 'admin') {
                    $user->role = 'candidate';
                }
            }
            if ($user->role != 'admin' && $user->role != 'supplier' && $user->role != 'manufacturer' && $user->role != 'candidate') {
                $user->parent_id = $this->request->data('parrentManufacturer');
                $parentUser = $this->Users->get($user->parent_id);
                $user->parentusername = $parentUser->username;
            }
			if(isset($this->request->data['terms']) && $this->request->data['terms'] != ''){
				$user->terms = $this->request->data['terms'];
			}else{
				$user->terms = '<table cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*Estimate is subject to check measure Creadit card payment incurs 1% fee</td><td class="no-border" style="border:none !important;">*Installation includes any freight/delivery charges if applicable</td><td class="no-border" style="border:none !important;">Bank Details</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*This estimate is valid for 30 days*</td><td class="no-border" style="border:none !important;"><strong>Please use the Order No as your payment reference</strong></td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">Please sign and return as authorisation that you would like to proceed with this Estimate, but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and Conditions it in their entirety.</td></tr></tbody></table>';
			}
			
			$meta_key = 'invoice-settings';
			$meta_value = 'YToxOntzOjg6InNldHRpbmdzIjthOjQ6e3M6ODoicHJvZHVjdHMiO2E6Mjp7czo1OiJ2YWx1ZSI7YTo1OntzOjE5OiJwcm9kdWN0X2l0ZW1fbnVtYmVyIjtzOjE6IjEiO3M6MTE6InByb2R1Y3RfcXR5IjtzOjE6IjEiO3M6MjU6InByb2R1Y3Rfc2VjX2RpZ19wZXJmX2ZpYnIiO3M6MToiMSI7czoyMjoicHJvZHVjdF93aW5kb3dfb3JfZG9vciI7czoxOiIxIjtzOjIxOiJwcm9kdWN0X2NvbmZpZ3VyYXRpb24iO3M6MToiMSI7fXM6NToibGFiZWwiO2E6NTp7czoxOToicHJvZHVjdF9pdGVtX251bWJlciI7czozOiJOTy4iO3M6MTE6InByb2R1Y3RfcXR5IjtzOjg6IlF1YW50aXR5IjtzOjI1OiJwcm9kdWN0X3NlY19kaWdfcGVyZl9maWJyIjtzOjEyOiJQcm9kdWN0IFR5cGUiO3M6MjI6InByb2R1Y3Rfd2luZG93X29yX2Rvb3IiO3M6MTE6IldpbmRvdy9Eb29yIjtzOjIxOiJwcm9kdWN0X2NvbmZpZ3VyYXRpb24iO3M6MTM6IkNvbmZpZ3VyYXRpb24iO319czoyMDoiYWRkaXRpb25hbF9wZXJfbWV0ZXIiO2E6Mjp7czo1OiJ2YWx1ZSI7YTozOntzOjIyOiJhZGRpdGlvbmFsX2l0ZW1fbnVtYmVyIjtzOjE6IjEiO3M6MjA6ImFkZGl0aW9uYWxfcGVyX21ldGVyIjtzOjE6IjEiO3M6MTU6ImFkZGl0aW9uYWxfbmFtZSI7czoxOiIxIjt9czo1OiJsYWJlbCI7YTozOntzOjIyOiJhZGRpdGlvbmFsX2l0ZW1fbnVtYmVyIjtzOjg6Ikl0ZW0gTm8uIjtzOjIwOiJhZGRpdGlvbmFsX3Blcl9tZXRlciI7czo5OiJQZXIgTWV0ZXIiO3M6MTU6ImFkZGl0aW9uYWxfbmFtZSI7czoxODoiQWRkaXRpb25hbCBTZWN0aW9uIjt9fXM6MjE6ImFkZGl0aW9uYWxfcGVyX2xlbmd0aCI7YToyOntzOjU6InZhbHVlIjthOjM6e3M6MjI6ImFkZGl0aW9uYWxfaXRlbV9udW1iZXIiO3M6MToiMSI7czoyMToiYWRkaXRpb25hbF9wZXJfbGVuZ3RoIjtzOjE6IjEiO3M6MTU6ImFkZGl0aW9uYWxfbmFtZSI7czoxOiIxIjt9czo1OiJsYWJlbCI7YTozOntzOjIyOiJhZGRpdGlvbmFsX2l0ZW1fbnVtYmVyIjtzOjg6Ikl0ZW0gTm8uIjtzOjIxOiJhZGRpdGlvbmFsX3Blcl9sZW5ndGgiO3M6MTA6IlBlciBMZW5ndGgiO3M6MTU6ImFkZGl0aW9uYWxfbmFtZSI7czoxODoiQWRkaXRpb25hbCBTZWN0aW9uIjt9fXM6MTE6ImFjY2Vzc29yaWVzIjthOjI6e3M6NToidmFsdWUiO2E6Mzp7czoyMToiYWNjZXNzb3J5X2l0ZW1fbnVtYmVyIjtzOjE6IjEiO3M6MTQ6ImFjY2Vzc29yeV9lYWNoIjtzOjE6IjEiO3M6MTQ6ImFjY2Vzc29yeV9uYW1lIjtzOjE6IjEiO31zOjU6ImxhYmVsIjthOjM6e3M6MjE6ImFjY2Vzc29yeV9pdGVtX251bWJlciI7czo4OiJJdGVtIE5vLiI7czoxNDoiYWNjZXNzb3J5X2VhY2giO3M6NDoiRWFjaCI7czoxNDoiYWNjZXNzb3J5X25hbWUiO3M6MTk6IkFjY2Vzc29yaWVzIFNlY3Rpb24iO319fX0=';
			$datetime = date("Y-m-d H:i:s");
			$usersTable = TableRegistry::get('users');
			$users_settings = TableRegistry::get('users_settings');
			$settings = $users_settings->newEntity();
			
			
			//$user->terms = serialize($this->request->data['terms']);
            //if ($this->Users->save($user)) {
				//$rec=$usersTable->save($user)
			if ($rec=$usersTable->save($user)) {
				$record_id = $rec->id; 
				if(isset($record_id)){
					$settings->id=null;
					$settings->user_id = $record_id;
					$settings->meta_key = $meta_key;
					$settings->meta_value = $meta_value;
					$settings->created = $datetime;					

					//$fields = array('user_id'=> $record_id,'meta_key'=> $meta_key,'meta_value'=> $meta_value,'created'=> $datetime);
					$users_settings->save($settings);
				}

                if (isset($this->request->data['send_notification'])) {
                    $this->sendEmail($user->email, 'new_user', $user);
                }
                
                $this->Flash->success(__('The new user has been saved.'));
                if ($user->role == 'manufacturer') {
                    $this->copyallpartstomf($user->id);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }


        $mfs = $this->Users->find('all')->where(['role' => 'manufacturer'])->select(['id', 'username']);
        $this->set(compact('user', 'mfs'));
    }

    /*********************************End-add************************************/
    /************************Start-addManufacturer*******************************/

    public function addManufacturer()
    {
        $this->authorize(['supplier']);

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['role'] = 'manufacturer';
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->parent_id = $this->Auth->user('id');
            $user->parentusername = $this->Users->get($user->parent_id)->username;
            
            if ($this->Users->save($user)) {
                $this->sendEmail($user->email, 'new_user', $user);
                $this->copyallpartstomf($user->id);
                $this->Flash->success(__('The Manufacturer has been saved.'));
                return $this->redirect(['action' => 'manufacturers']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);


    }
    /************************End-addManufacturer*******************************/


    /************************Start-edit*******************************/

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        $isOwned = $this->isAuthorized($user);
        $role = $this->Auth->user('role');

        if (!$isOwned) {
            $this->authorize(['supplier', 'admin']);
        }

        $user = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {


            if (!empty($this->request->data['file']['tmp_name'])) {
                $uploadedImageFileContent = file_get_contents($this->request->data['file']['tmp_name']);

                $user->avatar = $uploadedImageFileContent;

            }


            if ($this->request->data['new_password']) {
                /*$this->Users->patchEntity($user, [
                    'password' => $this->request->data['new_password'],
                    'new_password' => $this->request->data['new_password'],
                    'confirm_password' => $this->request->data['confirm_password'],
                ],
                    ['validate' => 'password']
                );*/
                $this->request->data['password'] = $this->request->data['new_password'];
                $this->Users->patchEntity($user, $this->request->data);

            } else {
                unset($this->request->data['new_password']);
                unset($this->request->data['confirm_password']);
                $this->Users->patchEntity($user, $this->request->data);
            }

            if ($role == 'supplier') {
                if ($user->role == 'admin') {
                    $user->role = 'candidate';
                }
            }
            
            if ($user->role != 'admin' && $user->role != 'supplier' && $user->role != 'manufacturer' && $user->role != 'candidate') {
                $user->parent_id = $this->request->data('parrentManufacturerId');
                $user->parentusername = $this->Users->get($user->parent_id)->username;
            } else {
                $user->parent_id = null;
                $user->parentusername = '';
            }
           	if(isset($this->request->data['terms']) && $this->request->data['terms'] != ''){
				$user->terms = $this->request->data['terms'];
			}else{
				$user->terms = '<table cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*Estimate is subject to check measure Creadit card payment incurs 1% fee</td><td class="no-border" style="border:none !important;">*Installation includes any freight/delivery charges if applicable</td><td class="no-border" style="border:none !important;">Bank Details</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*This estimate is valid for 30 days*</td><td class="no-border" style="border:none !important;"><strong>Please use the Order No as your payment reference</strong></td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">Please sign and return as authorisation that you would like to proceed with this Estimate, but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and Conditions it in their entirety.</td></tr></tbody></table>';
			}
			if ($this->Users->save($user)) {
                if ($user->role == 'manufacturer') {
                    $this->copyallpartstomf($user->id);
                }
                $this->Flash->success(__('User has been updated.'));

                //*** Update authUser variable ***
                if ($isOwned) {
                    $this->Auth->setUser($user);
                }
                if ($role == 'admin' || $role == 'supplier') {
                    return $this->redirect(['action' => 'index']);
                }

                return $this->redirect('/');

            }
            $this->Flash->error(__('Unable to update the user.'));
        }


        $mfs = $this->Users->find('all')->where(['role' => 'manufacturer'])->select(['id', 'username']);
        $this->set(compact('user', 'isOwned', 'mfs'));

    }

    /************************End-edit*******************************/

    /************************Start-manufacturerEdit*******************************/

    public function manufacturerEdit($id = null)
    {
//        not used anymore
        $role = $this->Auth->user('role');
        if ($role == 'supplier') {
            if ($this->request->is(['post', 'put'])) {
                $user = $this->Users->get($id);
                if ($this->request->is(['post', 'put'])) {
                    $this->Users->patchEntity($user, $this->request->data);
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Manufacturer has been updated.'));
                        return $this->redirect(['action' => 'manufacturers']);
                    }
                    $this->Flash->error(__('Unable to update your user.'));
                }

                $this->set('user', $user);
            }
        } else {

            $this->Flash->error(__('You are not authorized to view this page.'));
            return $this->redirect('/');
        }
    }

    /************************End-manufacturerEdit*******************************/

    /************************Start-login*******************************/

    public function login()
    {

        $this->viewBuilder()->layout('pantherpro-login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                //$this->_setCookie();
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    /************************End-login*******************************/

    /************************Start-logout*******************************/
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /************************End-logout*******************************/

    /************************Start-delete*******************************/
    public function delete($id)
    {
        $this->authorize(['admin', 'supplier']);
        $this->request->allowMethod(['post', 'delete']);

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user with id: {0} has been deleted.', h($id)));
            if ($this->Auth->user('role') == 'supplier') {
                return $this->redirect(['action' => 'manufacturers']);
            }
            return $this->redirect(['action' => 'index']);
        }


    }

    /************************End-delete*******************************/


    public function isAuthorized($user)
    {
        // All viewers can register
        if ($this->request->action === 'register') {
            return true;
        }

        // The owner of an users (user) can edit
        if ($this->Auth->user('id') == $user->id) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    protected function _setCookie()
    {
        if (!$this->request->data('remember_me')) {
            return false;
        }
        $data = [
            'username' => $this->request->data('username'),
            'password' => $this->request->data('password')
        ];
        $this->Cookie->write('rememberMe', $data, true, '2 weeks');
        return true;
    }


    private function copyallpartstomf($id = null)
    {
        //This method would copy all parts to the new or edited MF user

        $usersparts = TableRegistry::get('users_parts');
        $parts = TableRegistry::get('Parts')->find('all');

        $hasPart = $usersparts->find('all')->where(['user_id' => $id])->count() > 0;

        if (!$hasPart) {
            $entities = [];
            foreach ($parts as $part) {
                $entity = $usersparts->newEntity();
                $entity->buy_price_include_GST = $part->buy_price_include_GST;
                $entity->mark_up = $part->mark_up;
                $entity->marked_up = $part->mark_up;
                $entity->price_per_unit = $part->price_per_unit;
                $entity->user_id = $id;
                $entity->part_id = $part->id;
                $entities[] = $entity;
            }

            if (count($entities) > 0 && !$usersparts->saveMany($entities)) {
                $this->Flash->error(__('User parts cannot be saved!'));
                return $this->redirect('/');
            }
        }

    }   

}
