<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customitems Controller
 *
 * @property \App\Model\Table\CustomitemsTable $Customitems
 */
class CustomitemsController extends AppController
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
        $customitems = $this->paginate($this->Customitems);

        $this->set(compact('customitems'));
        $this->set('_serialize', ['customitems']);
    }

    /**
     * View method
     *
     * @param string|null $id Customitem id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customitem = $this->Customitems->get($id, [
            'contain' => ['Quotes']
        ]);

        $this->set('customitem', $customitem);
        $this->set('_serialize', ['customitem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customitem = $this->Customitems->newEntity();
        if ($this->request->is('post')) {
            $customitem = $this->Customitems->patchEntity($customitem, $this->request->data);
            if ($this->Customitems->save($customitem)) {
                $this->Flash->success(__('The customitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customitem could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Customitems->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('customitem', 'quotes'));
        $this->set('_serialize', ['customitem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Customitem id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customitem = $this->Customitems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customitem = $this->Customitems->patchEntity($customitem, $this->request->data);
            if ($this->Customitems->save($customitem)) {
                $this->Flash->success(__('The customitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The customitem could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Customitems->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('customitem', 'quotes'));
        $this->set('_serialize', ['customitem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customitem id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customitem = $this->Customitems->get($id);
        if ($this->Customitems->delete($customitem)) {
            $this->Flash->success(__('The customitem has been deleted.'));
        } else {
            $this->Flash->error(__('The customitem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
