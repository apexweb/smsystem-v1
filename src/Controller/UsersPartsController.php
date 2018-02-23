<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersParts Controller
 *
 * @property \App\Model\Table\UsersPartsTable $UsersParts
 */
class UsersPartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Parts']
        ];
        $usersParts = $this->paginate($this->UsersParts);

        $this->set(compact('usersParts'));
        $this->set('_serialize', ['usersParts']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Part id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersPart = $this->UsersParts->get($id, [
            'contain' => ['Users', 'Parts']
        ]);

        $this->set('usersPart', $usersPart);
        $this->set('_serialize', ['usersPart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersPart = $this->UsersParts->newEntity();
        if ($this->request->is('post')) {
            $usersPart = $this->UsersParts->patchEntity($usersPart, $this->request->data);
            if ($this->UsersParts->save($usersPart)) {
                $this->Flash->success(__('The users part has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users part could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersParts->Users->find('list', ['limit' => 200]);
        $parts = $this->UsersParts->Parts->find('list', ['limit' => 200]);
        $this->set(compact('usersPart', 'users', 'parts'));
        $this->set('_serialize', ['usersPart']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Part id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersPart = $this->UsersParts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersPart = $this->UsersParts->patchEntity($usersPart, $this->request->data);
            if ($this->UsersParts->save($usersPart)) {
                $this->Flash->success(__('The users part has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users part could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersParts->Users->find('list', ['limit' => 200]);
        $parts = $this->UsersParts->Parts->find('list', ['limit' => 200]);
        $this->set(compact('usersPart', 'users', 'parts'));
        $this->set('_serialize', ['usersPart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Part id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersPart = $this->UsersParts->get($id);
        if ($this->UsersParts->delete($usersPart)) {
            $this->Flash->success(__('The users part has been deleted.'));
        } else {
            $this->Flash->error(__('The users part could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
