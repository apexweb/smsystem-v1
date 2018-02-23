<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Stocks Controller
 *
 * @property \App\Model\Table\StocksTable $Stocks
 */
class StocksController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow([
                'index',
                'orderslist',
                'cuttingschedule',
                'addmaterials',
                'delete',
                'deletefromstock',
                'markasinactive',
                'export'
            ]);
        }

    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->authorize(['manufacturer']);
        $stocks = $this->Stocks->find('all');
        $status = null;
        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
            if ($status) {
                $stocks->where(['status' => $status]);
            }
        }

        $this->set(compact('stocks', 'status'));
    }


    /*
     * orders-list-for-combined-stock
    */
    public function orderslist()
    {
        $this->authorize(['manufacturer']);
        $quotes = TableRegistry::get('Quotes');
        $quotes = $quotes->find('all', ['contain' => ['Stockmetas']])
            ->where(['status !=' => 'pending'])
            ->where(['status !=' => 'expired'])
            ->order(['created' => 'DESC']);

        $this->set(compact('quotes'));
    }


    public function cuttingschedule($id = null)
    {
        $this->authorize(['manufacturer']);
        $quotes = TableRegistry::get('Quotes');
        $quote = $quotes->get($id, [
            'contain' => [
                'Products' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Midrails' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Additionalpermeters' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Additionalperlength' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Accessories' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Customitems' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Users' => function ($q) {
                    return $q->select(['username']);
                }
            ]
        ]);

        $stocks = $this->Stocks->find('all')->order(['created' => 'DESC']);

        $this->set(compact(['quote', 'stocks']));
    }


    public function addmaterials()
    {
        $this->authorize(['manufacturer']);
        $this->request->allowMethod(['post']);


        $stockmetas = TableRegistry::get('Stockmetas');
        $quoteId = $this->request->data('quote_id');
        $stockId = $this->request->data('stock');
        $new = $this->request->data('new');

//
//
        if ($new) {
            $stock = $this->Stocks->newEntity();
            $stock->status = 'active';
            $stock->mf_id = $this->Auth->user('id');
            if ($this->Stocks->save($stock)) {
                $stockId = $stock->id;
                $stockmetas->updateAll(['stock_id' => $stockId], ['quote_id' => $quoteId]);
            } else {
                $this->Flash->error(__('The stock could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'orderslist']);
            }
        }
        $stockmetas->updateAll(['stock_id' => $stockId], ['quote_id' => $quoteId]);

        //$this->Flash->success(__('Success!'));
        return $this->redirect(['action' => 'view', $stockId]);

    }

    /**
     * View method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->authorize(['manufacturer']);
        $stock = $this->Stocks->get($id, [
            'contain' => ['Stockmetas.Quotes' => [
                'Products',
                'Midrails',
                'Additionalpermeters',
                'Additionalperlength',
                'Accessories',
                'Customitems']
            ]
        ]);


//        $Stockmetas = TableRegistry::get('Stockmetas');
//        $orders = $Stockmetas->find('all',
//            ['contain' =>
//                ['Quotes' => function ($q) {
//                    return $q
//                        ->select(['id'])
//                        ->contain(['Additionalpermeters', 'Additionalperlength', 'Accessories', 'Customitems', 'Stockmetas']);
//                }
//                ]])
//            ->where(['stock_id' => $id])->group('quote_id');


        $orders = $this->groupBy($stock->stockmetas, 'quote_id');
        //debug($orders);

        $this->set(compact(['stock', 'orders']));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $stock = $this->Stocks->newEntity();
        if ($this->request->is('post')) {
            $stock = $this->Stocks->patchEntity($stock, $this->request->data);
            if ($this->Stocks->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stock could not be saved. Please, try again.'));
            }
        }
        $mfs = $this->Stocks->Mfs->find('list', ['limit' => 200]);
        $this->set(compact('stock', 'mfs'));
        $this->set('_serialize', ['stock']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $stock = $this->Stocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stock = $this->Stocks->patchEntity($stock, $this->request->data);
            if ($this->Stocks->save($stock)) {
                $this->Flash->success(__('The stock has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stock could not be saved. Please, try again.'));
            }
        }
        $mfs = $this->Stocks->Mfs->find('list', ['limit' => 200]);
        $this->set(compact('stock', 'mfs'));
        $this->set('_serialize', ['stock']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stock id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function deletefromstock($stockId = null, $quoteId)
    {
        $this->authorize(['manufacturer']);
        $this->request->allowMethod(['post', 'delete']);
        $Stockmetas = TableRegistry::get('Stockmetas');
        if ($Stockmetas->updateAll(['stock_id' => null], ['quote_id' => $quoteId])) {
            $this->Flash->success(__('The quote has been deleted from the stock.'));
        } else {
            $this->Flash->error(__('The quote could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'view', $stockId]);

    }


    public function markasinactive($stockId = null)
    {
        $this->authorize(['manufacturer']);
        $this->request->allowMethod(['patch', 'post', 'put']);
        $stock = $this->Stocks->get($stockId);
        $stock->status = 'inactive';
        if ($this->Stocks->save($stock)) {
            $this->Flash->success(__('The Stock has been marked as Inactive.'));
        } else {
            $this->Flash->error(__('The Stock status could not be changed. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function delete($id = null)
    {
        $this->authorize(['manufacturer']);
        $this->request->allowMethod(['post', 'delete']);
        $stock = $this->Stocks->get($id);
        if ($this->Stocks->delete($stock)) {
            $this->Stocks->Stockmetas->updateAll(['stock_id' => null], ['stock_id' => $stock->id]);
            $this->Flash->success(__('The stock has been deleted.'));
        } else {
            $this->Flash->error(__('The stock could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


//    public function export()
//    {
//        $this->response->download('export.csv');
//        $data = [
//            ['a', 'b', 'c'],
//            [1, 2, 3],
//            ['you', 'and', 'me'],
//        ];
//        $_serialize = 'data';
//
//
//        $this->viewBuilder()->className('CsvView.csv');
//        $this->set(compact('data', '_serialize'));
//        return;
//    }


    private function groupBy($arr, $field)
    {
        $result = array();
        foreach ($arr as $data) {
            $id = $data[$field];
            if (isset($result[$id])) {
                $result[$id][] = $data;
            } else {
                $result[$id] = array($data);
            }
        }
        return $result;
    }
}
