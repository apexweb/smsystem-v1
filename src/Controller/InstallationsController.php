<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Installations Controller
 *
 * @property \App\Model\Table\InstallationsTable $Installations
 */
class InstallationsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        if ($this->Auth->user()) {
            $this->Auth->allow([
                'index',
            ]);
        }

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->authorize(['manufacturer', 'distributor', 'wholesaler', 'retailer']);

        $userId = $this->Auth->user('id');
        $installation = $this->Installations->find('all')->where(['user_id' => $userId])->first();
        if (!$installation) {
            $installation = $this->Installations->newEntity();
            $installation->user_id = $userId;
        }

        if ($this->request->is('post')) {
            $installation = $this->Installations->patchEntity($installation, $this->request->data);
            if ($this->Installations->save($installation)) {
                $this->Flash->success(__('The installation amounts have been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The installation amounts could not be saved. Please, try again.'));
            }
        }
        $this->set('installation', $installation);
    }

    /**
     * View method
     *
     * @param string|null $id Installation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $installation = $this->Installations->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('installation', $installation);
        $this->set('_serialize', ['installation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->authorize(['manufacturer', 'distributor', 'wholesaler', 'retailer']);
        
        $installation = $this->Installations->newEntity();
        if ($this->request->is('post')) {
            $installation = $this->Installations->patchEntity($installation, $this->request->data);
            if ($this->Installations->save($installation)) {
                $this->Flash->success(__('The installation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The installation could not be saved. Please, try again.'));
            }
        }
        $users = $this->Installations->Users->find('list', ['limit' => 200]);
        $this->set(compact('installation', 'users'));
        $this->set('_serialize', ['installation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Installation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $installation = $this->Installations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $installation = $this->Installations->patchEntity($installation, $this->request->data);
            if ($this->Installations->save($installation)) {
                $this->Flash->success(__('The installation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The installation could not be saved. Please, try again.'));
            }
        }
        $users = $this->Installations->Users->find('list', ['limit' => 200]);
        $this->set(compact('installation', 'users'));
        $this->set('_serialize', ['installation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Installation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $installation = $this->Installations->get($id);
        if ($this->Installations->delete($installation)) {
            $this->Flash->success(__('The installation has been deleted.'));
        } else {
            $this->Flash->error(__('The installation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
