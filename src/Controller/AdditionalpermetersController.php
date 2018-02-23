<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Additionalpermeters Controller
 *
 * @property \App\Model\Table\AdditionalpermetersTable $Additionalpermeters
 */
class AdditionalpermetersController extends AppController
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
        $additionalpermeters = $this->paginate($this->Additionalpermeters);

        $this->set(compact('additionalpermeters'));
        $this->set('_serialize', ['additionalpermeters']);
    }

    /**
     * View method
     *
     * @param string|null $id Additionalpermeter id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $additionalpermeter = $this->Additionalpermeters->get($id, [
            'contain' => ['Quotes']
        ]);

        $this->set('additionalpermeter', $additionalpermeter);
        $this->set('_serialize', ['additionalpermeter']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $additionalpermeter = $this->Additionalpermeters->newEntity();
        if ($this->request->is('post')) {
            $additionalpermeter = $this->Additionalpermeters->patchEntity($additionalpermeter, $this->request->data);
            if ($this->Additionalpermeters->save($additionalpermeter)) {
                $this->Flash->success(__('The additionalpermeter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The additionalpermeter could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Additionalpermeters->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('additionalpermeter', 'quotes'));
        $this->set('_serialize', ['additionalpermeter']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Additionalpermeter id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $additionalpermeter = $this->Additionalpermeters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $additionalpermeter = $this->Additionalpermeters->patchEntity($additionalpermeter, $this->request->data);
            if ($this->Additionalpermeters->save($additionalpermeter)) {
                $this->Flash->success(__('The additionalpermeter has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The additionalpermeter could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Additionalpermeters->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('additionalpermeter', 'quotes'));
        $this->set('_serialize', ['additionalpermeter']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Additionalpermeter id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $additionalpermeter = $this->Additionalpermeters->get($id);
        if ($this->Additionalpermeters->delete($additionalpermeter)) {
            $this->Flash->success(__('The additionalpermeter has been deleted.'));
        } else {
            $this->Flash->error(__('The additionalpermeter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
