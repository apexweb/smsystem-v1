<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Core\Exception\Exception;

/**
 * Dropdowns Controller
 *
 * @property \App\Model\Table\DropdownsTable $Dropdowns
 */
class DropdownsController extends AppController
{


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow(['index', 'delete', 'uploadcsv']);
        }

    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent

        $this->viewBuilder()->layout('pantherpro-in');

    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->authorize(['manufacturer', 'supplier']);

        $dropdowns = $this->Dropdowns->find('all')->where(['user_id' => $this->Auth->user('id')])->orderAsc('manual_sort');

        if (!$dropdowns) {
            $dropdowns = [];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $dropdown = $this->Dropdowns->newEntity();
            $dropdown = $this->Dropdowns->patchEntity($dropdown, $this->request->data);
            $dropdown->user_id = $this->Auth->user('id');
            if ($this->Dropdowns->save($dropdown)) {
                $this->Flash->success(__('The dropdown values has been updated.'));
            } else {
                $this->Flash->error(__('The new option could not be saved. Please, try again.'));
            }
        }
        $role = $this->Auth->user('role');
        $userIds = [];
        if ($role == 'supplier') {
            $users = TableRegistry::get('Users');
            $userIds = $users->find('all')
                ->where(['Users.role' => 'manufacturer', 'Users.parent_id' => $this->Auth->user('id')]);//                

            $userIds = $userIds->toArray();
        }
            
        $this->set(compact('dropdowns','userIds'));
//        $this->set('_serialize', ['dropdowns']);
    }


    public function uploadcsv()
    {
        $this->authorize(['manufacturer', 'supplier']);

        
        $dropdowns = null;
        $role = $this->Auth->user('role');
        if ($role == 'manufacturer') {
            $userIds = array($this->Auth->user('id'));
        }else if ($role == 'supplier') {
            $users = TableRegistry::get('Users');
            $userIds = $users->find('list', ['keyField' => 'id', 'valueField' => 'id'])
                ->where(['Users.role' => 'manufacturer', 'Users.parent_id' => $this->Auth->user('id')]);//                
            
           // $userIds = $userIds->toArray();
           // array_push($userIds, $this->Auth->user('id'));
          //  print_r($userIds);die;
        }
     
        $saved = false;

        if ($this->request->is('post')) {
            if (!empty($this->request->data['file']['name']) || !isset($this->request->data['type'])) {
                $fileName = $this->request->data['file']['tmp_name'];
                try {
                    $contents = file_get_contents($fileName);
                    $lines = explode(PHP_EOL, $contents);
                    $dropdowns = $this->generateDropdownArray($lines);

                } catch (Exception $e) {
                    $dropdowns = null;
                }
                $userIds = [];
                if ($role == 'manufacturer') {
                    $userIds = array($this->Auth->user('id'));
                }else if ($role == 'supplier') { 
                    if(isset($this->request->data['all-manufacturers']) && $this->request->data['all-manufacturers'] == 1){
                    $users = TableRegistry::get('Users');
                    $userIds = $users->find('list', ['keyField' => 'id', 'valueField' => 'id'])
                            ->where(['Users.role' => 'manufacturer', 'Users.parent_id' => $this->Auth->user('id')]);//                
            
                    $userIds = $userIds->toArray();
                    }elseif(isset($this->request->data['manufacturer']) && !empty($this->request->data['manufacturer'])){
                        foreach($this->request->data['manufacturer'] as $key => $val){
                            if($val > 0){
                                array_push($userIds, $key);
                            }
                        }
                    }
                    array_push($userIds, $this->Auth->user('id'));
                }          
                
                if (is_array($dropdowns)) {
                    
                    if ($userIds) {
                        
                        foreach ($userIds as $userId) {
                    
                            $type = $this->request->data['type'];
                            $entities = [];

                            foreach ($dropdowns as $dropdown) {
                                if (isset($dropdown[0]) && $dropdown[0] != null && !$this->strictEmpty($dropdown[0])) {
                                    $entity = $this->Dropdowns->newEntity();
                                    $entity->name = $dropdown[0];
                                    $entity->manual_sort = isset($dropdown[1]) ? $dropdown[1] : 1000;
                                    $entity->rule_code = isset($dropdown[2]) ? $dropdown[2] : '';
                                    $entity->type = $type;
                                    $entity->user_id = $userId;

                                    $entities[] = $entity;
                                }
                            }

                            if (isset($this->request->data['deleteall']) && $this->request->data['deleteall'] == 1) {
                                $this->Dropdowns->deleteAll(['user_id' => $userId, 'type' => $type]);
                            }
                            if ($this->Dropdowns->saveMany($entities)) {
                                $saved = true;
                            }
                        }
                    }
                }
            }
        }
        if ($saved){
            $this->Flash->success(__('The CSV file has been successfully imported.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->Flash->error(__('Invalid CSV file, Please try again.'));
        return $this->redirect(['action' => 'index']);
    }


    private function generateDropdownArray($lines)
    {
        $finalArr = [];
        foreach ($lines as $line) {
            $finalArr[] = str_getcsv($line);//, ',', '"');
        }
        if (count($finalArr) > 0) {
            return $finalArr;
        }
        return null;
    }

    /**
     * View method
     *
     * @param string|null $id Dropdown id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dropdown = $this->Dropdowns->get($id, [
            'contain' => []
        ]);

        $this->set('dropdown', $dropdown);
        $this->set('_serialize', ['dropdown']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dropdown = $this->Dropdowns->newEntity();
        if ($this->request->is('post')) {
            $dropdown = $this->Dropdowns->patchEntity($dropdown, $this->request->data);
            if ($this->Dropdowns->save($dropdown)) {
                $this->Flash->success(__('The dropdown has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dropdown could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dropdown'));
        $this->set('_serialize', ['dropdown']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dropdown id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dropdown = $this->Dropdowns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dropdown = $this->Dropdowns->patchEntity($dropdown, $this->request->data);
            if ($this->Dropdowns->save($dropdown)) {
                $this->Flash->success(__('The dropdown has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dropdown could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('dropdown'));
        $this->set('_serialize', ['dropdown']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dropdown id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->authorize(['manufacturer']);

        $this->request->allowMethod(['post', 'delete']);
        $dropdown = $this->Dropdowns->get($this->request->data['id']);
        if ($this->Dropdowns->delete($dropdown)) {
            $this->Flash->success(__('The value has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    private function strictEmpty($var) {

        $var = trim($var);

        if(isset($var) === true && $var === '') {

            return true;

        }

        return false;
    }
}
