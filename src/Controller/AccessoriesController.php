<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Accessories Controller
 *
 * @property \App\Model\Table\AccessoriesTable $Accessories
 */
class AccessoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Quotes']
        ];
        $accessories = $this->paginate($this->Accessories);

        $this->set(compact('accessories'));
        $this->set('_serialize', ['accessories']);
    }

    /**
     * View method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accessory = $this->Accessories->get($id, [
            'contain' => ['Quotes']
        ]);

        $this->set('accessory', $accessory);
        $this->set('_serialize', ['accessory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accessory = $this->Accessories->newEntity();
        if ($this->request->is('post')) {
            $accessory = $this->Accessories->patchEntity($accessory, $this->request->data);
            if ($this->Accessories->save($accessory)) {
                $this->Flash->success(__('The accessory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The accessory could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Accessories->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('accessory', 'quotes'));
        $this->set('_serialize', ['accessory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accessory = $this->Accessories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessory = $this->Accessories->patchEntity($accessory, $this->request->data);
            if ($this->Accessories->save($accessory)) {
                $this->Flash->success(__('The accessory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The accessory could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Accessories->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('accessory', 'quotes'));
        $this->set('_serialize', ['accessory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accessory = $this->Accessories->get($id);
        if ($this->Accessories->delete($accessory)) {
            $this->Flash->success(__('The accessory has been deleted.'));
        } else {
            $this->Flash->error(__('The accessory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
