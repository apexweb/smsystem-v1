<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Additionalperlength Controller
 *
 * @property \App\Model\Table\AdditionalperlengthTable $Additionalperlength
 */
class AdditionalperlengthController extends AppController
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
        $additionalperlength = $this->paginate($this->Additionalperlength);

        $this->set(compact('additionalperlength'));
        $this->set('_serialize', ['additionalperlength']);
    }

    /**
     * View method
     *
     * @param string|null $id Additionalperlength id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $additionalperlength = $this->Additionalperlength->get($id, [
            'contain' => ['Quotes']
        ]);

        $this->set('additionalperlength', $additionalperlength);
        $this->set('_serialize', ['additionalperlength']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $additionalperlength = $this->Additionalperlength->newEntity();
        if ($this->request->is('post')) {
            $additionalperlength = $this->Additionalperlength->patchEntity($additionalperlength, $this->request->data);
            if ($this->Additionalperlength->save($additionalperlength)) {
                $this->Flash->success(__('The additionalperlength has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The additionalperlength could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Additionalperlength->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('additionalperlength', 'quotes'));
        $this->set('_serialize', ['additionalperlength']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Additionalperlength id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $additionalperlength = $this->Additionalperlength->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $additionalperlength = $this->Additionalperlength->patchEntity($additionalperlength, $this->request->data);
            if ($this->Additionalperlength->save($additionalperlength)) {
                $this->Flash->success(__('The additionalperlength has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The additionalperlength could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Additionalperlength->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('additionalperlength', 'quotes'));
        $this->set('_serialize', ['additionalperlength']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Additionalperlength id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $additionalperlength = $this->Additionalperlength->get($id);
        if ($this->Additionalperlength->delete($additionalperlength)) {
            $this->Flash->success(__('The additionalperlength has been deleted.'));
        } else {
            $this->Flash->error(__('The additionalperlength could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
