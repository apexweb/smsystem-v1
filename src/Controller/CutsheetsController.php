<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cutsheets Controller
 *
 * @property \App\Model\Table\CutsheetsTable $Cutsheets
 */
class CutsheetsController extends AppController
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
        $cutsheets = $this->paginate($this->Cutsheets);

        $this->set(compact('cutsheets'));
        $this->set('_serialize', ['cutsheets']);
    }

    /**
     * View method
     *
     * @param string|null $id Cutsheet id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cutsheet = $this->Cutsheets->get($id, [
            'contain' => ['Quotes']
        ]);

        $this->set('cutsheet', $cutsheet);
        $this->set('_serialize', ['cutsheet']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cutsheet = $this->Cutsheets->newEntity();
        if ($this->request->is('post')) {
            $cutsheet = $this->Cutsheets->patchEntity($cutsheet, $this->request->data);
            if ($this->Cutsheets->save($cutsheet)) {
                $this->Flash->success(__('The cutsheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cutsheet could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Cutsheets->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('cutsheet', 'quotes'));
        $this->set('_serialize', ['cutsheet']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cutsheet id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cutsheet = $this->Cutsheets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cutsheet = $this->Cutsheets->patchEntity($cutsheet, $this->request->data);
            if ($this->Cutsheets->save($cutsheet)) {
                $this->Flash->success(__('The cutsheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cutsheet could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Cutsheets->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('cutsheet', 'quotes'));
        $this->set('_serialize', ['cutsheet']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cutsheet id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cutsheet = $this->Cutsheets->get($id);
        if ($this->Cutsheets->delete($cutsheet)) {
            $this->Flash->success(__('The cutsheet has been deleted.'));
        } else {
            $this->Flash->error(__('The cutsheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
