<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Core\Exception\Exception;

class SettingsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
       if ($this->Auth->user()) {
            $this->Auth->allow(['index']);
        }

    }
    
    public function index()
    {
        $settings = $this->Settings->find('all')
                        ->where(['user_id' => $this->Auth->user('id'), 'meta_key' => 'invoice-settings'])->first();
                    
        if (empty($settings)) {
            $settings = $this->Settings->newEntity();
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {            
            $settings = $this->Settings->patchEntity($settings, $this->request->data);
            $settings->user_id = $this->Auth->user('id');
            $settings->meta_key = 'invoice-settings';
            $settings->meta_value = base64_encode(serialize($this->request->data));
            
            if ($this->Settings->save($settings)) {
                $this->Flash->success(__('The field settings has been saved.'));
            } else {
                $this->Flash->error(__('The field settings could not be saved. Please, try again.'));
            }
        }
        
        $this->set(compact('settings'));
        $this->set('_serialize', ['settings']);
    }
}
