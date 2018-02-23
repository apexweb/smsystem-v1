<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Stockmetas Controller
 *
 * @property \App\Model\Table\StockmetasTable $Stockmetas
 */
class StockmetasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $stockmetas = $this->Stockmetas->find('all');

        $this->set(compact('stockmetas'));
    }

    /**
     * View method
     *
     * @param string|null $id Stockmeta id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stockmeta = $this->Stockmetas->get($id, [
            'contain' => ['Stocks', 'Quotes']
        ]);



        $this->set('stockmeta', $stockmeta);
        $this->set('_serialize', ['stockmeta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stockmeta = $this->Stockmetas->newEntity();
        if ($this->request->is('post')) {
            $stockmeta = $this->Stockmetas->patchEntity($stockmeta, $this->request->data);
            if ($this->Stockmetas->save($stockmeta)) {
                $this->Flash->success(__('The stockmeta has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stockmeta could not be saved. Please, try again.'));
            }
        }
        $stocks = $this->Stockmetas->Stocks->find('list', ['limit' => 200]);
        $quotes = $this->Stockmetas->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('stockmeta', 'stocks', 'quotes'));
        $this->set('_serialize', ['stockmeta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Stockmeta id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stockmeta = $this->Stockmetas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stockmeta = $this->Stockmetas->patchEntity($stockmeta, $this->request->data);
            if ($this->Stockmetas->save($stockmeta)) {
                $this->Flash->success(__('The stockmeta has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stockmeta could not be saved. Please, try again.'));
            }
        }
        $stocks = $this->Stockmetas->Stocks->find('list', ['limit' => 200]);
        $quotes = $this->Stockmetas->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('stockmeta', 'stocks', 'quotes'));
        $this->set('_serialize', ['stockmeta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stockmeta id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stockmeta = $this->Stockmetas->get($id);
        if ($this->Stockmetas->delete($stockmeta)) {
            $this->Flash->success(__('The stockmeta has been deleted.'));
        } else {
            $this->Flash->error(__('The stockmeta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
