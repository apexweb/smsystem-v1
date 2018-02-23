<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Midrails Controller
 *
 * @property \App\Model\Table\MidrailsTable $Midrails
 */
class MidrailsController extends AppController
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
        $midrails = $this->paginate($this->Midrails);

        $this->set(compact('midrails'));
        $this->set('_serialize', ['midrails']);
    }

    /**
     * View method
     *
     * @param string|null $id Midrail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $midrail = $this->Midrails->get($id, [
            'contain' => ['Quotes']
        ]);

        $this->set('midrail', $midrail);
        $this->set('_serialize', ['midrail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $midrail = $this->Midrails->newEntity();
        if ($this->request->is('post')) {
            $midrail = $this->Midrails->patchEntity($midrail, $this->request->data);
            if ($this->Midrails->save($midrail)) {
                $this->Flash->success(__('The midrail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The midrail could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Midrails->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('midrail', 'quotes'));
        $this->set('_serialize', ['midrail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Midrail id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $midrail = $this->Midrails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $midrail = $this->Midrails->patchEntity($midrail, $this->request->data);
            if ($this->Midrails->save($midrail)) {
                $this->Flash->success(__('The midrail has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The midrail could not be saved. Please, try again.'));
            }
        }
        $quotes = $this->Midrails->Quotes->find('list', ['limit' => 200]);
        $this->set(compact('midrail', 'quotes'));
        $this->set('_serialize', ['midrail']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Midrail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $midrail = $this->Midrails->get($id);
        if ($this->Midrails->delete($midrail)) {
            $this->Flash->success(__('The midrail has been deleted.'));
        } else {
            $this->Flash->error(__('The midrail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
