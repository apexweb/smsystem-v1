<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Core\Exception\Exception;

class ContentsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow(['add', 'edit']);
        }

    }
    
    public function add()
    {
        $content = $this->Contents->newEntity();
        if ($this->request->is('post')) {
            $content = $this->Contents->patchEntity($content, $this->request->data);
            $content->user_id = $this->Auth->user('id');
            $content->label = 'importantinfo';
            
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['controller' => 'pages', 'action' => 'importantinfo']);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('content'));
        $this->set('_serialize', ['content']);
    }
    
    public function index()
    {
        $contents = $this->paginate($this->Contents, [
                'limit' => 20,
                'order' => [
                    'Contents.created' => 'DESC'
                ]]);
        $this->set('contents', $contents);
    }
    
    public function edit($id = null)
    {
        $this->authorize(['admin', 'manufacturer']);
        
        $content = $this->Contents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Contents->patchEntity($content, $this->request->data);
            $content->user_id = $this->Auth->user('id');
            if ($this->Contents->save($content)) {
                $this->Flash->success(__('The content has been saved.'));

                return $this->redirect(['controller' => 'pages', 'action' => 'importantinfo']);
            } else {
                $this->Flash->error(__('The content could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('content'));
        $this->set('_serialize', ['content']);
    }
}
