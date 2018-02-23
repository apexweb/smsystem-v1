<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Mcvalues Controller
 *
 * @property \App\Model\Table\McvaluesTable $Mcvalues
 */
class McvaluesController extends AppController
{


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow(['index']); //, 'add', 'edit', 'delete']);
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
        $this->authorize(['manufacturer']);

        $mcvalue = $this->Mcvalues->find('all')->where(['user_id' => $this->Auth->user('id')])->first();
        if (!$mcvalue) {
            $mcvalue = $this->Mcvalues->newEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $mcvalue = $this->Mcvalues->patchEntity($mcvalue, $this->request->data);
            $mcvalue->user_id = $this->Auth->user('id');
            if ($this->Mcvalues->save($mcvalue)) {
                $this->Flash->success(__('Master Calculator values has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The values could not be updated. Please, try again.'));
            }
        }

        $this->set(compact('mcvalue'));
        $this->set('_serialize', ['mcvalue']);
    }

    /**
     * View method
     *
     * @param string|null $id Mcvalue id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mcvalue = $this->Mcvalues->get($id, [
            'contain' => []
        ]);

        $this->set('mcvalue', $mcvalue);
        $this->set('_serialize', ['mcvalue']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mcvalue = $this->Mcvalues->newEntity();
        if ($this->request->is('post')) {
            $mcvalue = $this->Mcvalues->patchEntity($mcvalue, $this->request->data);
            if ($this->Mcvalues->save($mcvalue)) {
                $this->Flash->success(__('The mcvalue has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mcvalue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('mcvalue'));
        $this->set('_serialize', ['mcvalue']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mcvalue id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mcvalue = $this->Mcvalues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mcvalue = $this->Mcvalues->patchEntity($mcvalue, $this->request->data);
            if ($this->Mcvalues->save($mcvalue)) {
                $this->Flash->success(__('The mcvalue has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mcvalue could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('mcvalue'));
        $this->set('_serialize', ['mcvalue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mcvalue id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mcvalue = $this->Mcvalues->get($id);
        if ($this->Mcvalues->delete($mcvalue)) {
            $this->Flash->success(__('The mcvalue has been deleted.'));
        } else {
            $this->Flash->error(__('The mcvalue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
