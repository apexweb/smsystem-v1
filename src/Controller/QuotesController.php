<?php
namespace App\Controller;

use App\Calculator;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use CakePdf\Pdf\CakePdf;


/**
 * Quotes Controller
 *
 * @property \App\Model\Table\QuotesTable $Quotes
 * @property \App\Model\Table\ProductsTable $Products
 * @property \App\Model\Table\MidrailsTable $Midrails
 * @property \App\Model\Table\AdditionalpermetersTable $Additionalpermeters
 * @property \App\Model\Table\CustomitemsTable $Customitems
 *
 */
class QuotesController extends AppController
{


    //$$uses = array('Quote', 'Part');


    /**
     * @param Event $event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow([
                'index',
                'add',
                'edit',
                'delete',
                'roleselect',
                'printout',
                'installsheet',
                'cuttingschedule',
                'invoice',
                'funnelweb',
                'orders',
                'myquotes',
                'markascomplete',
                'markasexpired',
                'setquoted',
                'setprinted',
                'scheduler',
                'cuttingspdf',
                'installsheetpdf',
                'printoutpdf',
                'invoicepdf',
                'funnelwebpdf',
                'monthlyreportpdf',
                'pdf',
                'sendattachment',
                'autosavequote',
                'monthlyReport'
                //'test'
            ]);
        }

    }


    public function initialize()
    {
        parent::initialize();
    }


    public function test()
    {
        $widths = [700, 860, 910, 1010, 1110, 1310, 1720];
        $heights = [2100, 2500, 3110];

        $widths = json_encode($widths);
        $heights = json_encode($heights);

        $matrixTable = TableRegistry::get('Matrixtables');
        $matrix = $matrixTable->newEntity();
        $matrix->name = 'My test Matrix Table';
        $matrix->widths = $widths;
        $matrix->heights = $heights;
        if ($matrixTable->save($matrix)) {
            $this->Flash->success('Saved');
        } else {
            $this->Flash->error('Not succeed!');
        }
    }


    /******************** PDFs *************************/

    private function pdf($id, $name, $orientation)
    {
        $fieldSettings = '';
        $quote = $this->Quotes->get($id, [
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
                'Cutsheets' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Users' => function ($q) {
                    return $q->select(['username', 'avatar', 'firstname', 'lastname']);
                }
            ]
        ]);
            
        $filename = $quote->customer_name . '-' . $quote->qId;
        
        if ($name == 'CheckMeasure-InstallSheet') {            
            $filename = $quote->customer_name. '-Check Measure' ;             
        } elseif ($name == 'Invoice') {
            $flagSecurity = false;
            foreach ($quote->products as $product) {

                if ($product->product_qty > 0) {
                    if ($product->product_sec_dig_perf_fibr == 'Security') {
                        $flagSecurity = true;
                    }
                }
            }
            
            $total = $quote->invoiceCost;
            if ($flagSecurity) {
                $total = (float)$total + 8;
            }

            $additiona1 = $quote->invoice_second_1_price;
            $additiona2 = $quote->invoice_second_2_price;


            $final = round($total + $additiona1 + $additiona2, 0);
            $filename = $quote->customer_name . '-' . $final . '-' . $quote->qId; 
            $fieldSettings = TableRegistry::get('Settings');
            $fieldSettings = $fieldSettings->find('all')->where(['user_id' => $this->Auth->user('id'),'meta_key' => 'invoice-settings'])->first();
        } elseif ( $name == 'CuttingSchedule'){
            $filename = $quote->customer_name . '-' . $quote->qId . '-Cut Schedule';
        }
               
        $this->viewBuilder()->options([
            'pdfConfig' => [
                'filename' =>  $filename . '.pdf',
                'orientation' => $orientation,
            ]
        ]);
        
        $deductions = TableRegistry::get('Mcvalues');
        if ($this->Auth->user('role') == 'manufacturer') {
            $deductions = $deductions->find('all')->where(['user_id' => $this->Auth->user('id')])->first();
        } else {
            $deductions = $deductions->find('all')->where(['user_id' => $this->Auth->user('parent_id')])->first();
        }


        $this->set(compact('quote','deductions','fieldSettings'));
    }


    public function cuttingspdf($id = null)
    {
        $this->pdf($id, 'CuttingSchedule', 'landscape');
    }

    function installsheetpdf($id = null)
    {
        $this->pdf($id, 'CheckMeasure-InstallSheet', 'portrait');
    }

    function printoutpdf($id = null)
    {
        $this->pdf($id, 'Printout', 'portrait');
    }

    function invoicepdf($id = null)
    {
        $this->pdf($id, 'Invoice', 'portrait');
    }

    function funnelwebpdf($id = null)
    {
        $this->pdf($id, 'FW', 'portrait');
    }
    
    function monthlyreportpdf($id = null){
        
        $users = TableRegistry::get('Users');
        $invoices = TableRegistry::get('Invoices');
        $user = $users->get($id);
                
        $filename = 'SMS Usage Report';
        
        $month = date('m');
        $year = date('Y');
        
        $quotes = $this->Quotes->find('all', ['contain' => [
            'Users' => function ($q) {
                return $q->select(['business_name']);
            }
        ]])
            ->order(['Quotes.orderin_date' => 'DESC', 'FIELD(Quotes.role, "wholesaler", "manufacturer") DESC']);//, 

        $users = TableRegistry::get('Users');
         $userIds = $users->find('list', ['keyField' => 'id', 'valueField' => 'id'])
                ->where(['Users.parent_id' => $id]);

         $userIds = $userIds->toArray();
         array_push($userIds, $id);
         
         
        $quotes->where(['Quotes.user_id IN ' => $userIds]);
         
        //$quotes->where(['Quotes.user_id' => $id]);
        
        $quotes->andWhere(function ($exp) {
                return $exp->or_([
                    'Quotes.status' => 'complete',
                    ]);
                });
         
        $quotes->orWhere(['Quotes.status' => 'in progress']);
               
        if (isset($this->request->query['month'])) {
            $month = $this->request->query['month'];
        }
        if (isset($this->request->query['year'])) {
            $year = $this->request->query['year'];
        }

        $filename = $filename. ' ' .date('M', mktime(0, 0, 0, $month, 10)) . date('y', mktime(0, 0, 0, 0, 0, $year+1));
        
        //$quotes->where(['MONTH(Quotes.created)' => $month]);
        //$quotes->where(['YEAR(Quotes.created)' => $year]);
        $quotes->where(['date_format(str_to_date(`Quotes`.`orderin_date`, "%d/%m/%Y"), "%m") = '. $month]);
        $quotes->where(['date_format(str_to_date(`Quotes`.`orderin_date`, "%d/%m/%Y"), "%Y")='. $year]);
        
        $this->viewBuilder()->options([
            'pdfConfig' => [
                'filename' =>  $filename . '.pdf',
                'orientation' => 'portrait',
            ]
        ]);

        $invoice = $invoices->find('all')
                        ->order(['id' => 'DESC'])
                        ->first();
        
        $invoice = $invoices->newEntity();
        $invoice->user_id = $id;
        $invoice->month = $month;
        $invoice->year = $year;
        $invoices->save($invoice);

        $invoice_no = $invoice->id;
                
        $this->set(compact('quotes', 'user', 'invoice_no'));
        
    }

    /********************END PDF *************************/


    /*** Dist, Re, Whsl's Quotes Page ***/
    public function index()
    {
        $this->authorize(['distributor', 'wholesaler', 'retailer']);
        $search = null;
        $status = null;

        $fieldSettings = TableRegistry::get('Settings');
        $settings = $fieldSettings->find('all')
                        ->where(['user_id' => $this->Auth->user('id'), 'meta_key' => 'quote-draft'])->first();
        if($settings){
            
            $selected_fields = unserialize(base64_decode($settings->meta_value));
            if($this->saveQuote($selected_fields)){
                $fieldSettings->delete($settings);
            }            
        }

        if (isset($this->request->query['search'])) {
            $search = $this->request->query['search'];
        }
        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
        }


        $quotes = $this->Quotes->find('all', ['contain' => [
            'Users' => function ($q) {
                return $q->select(['username']);
            }
        ]])
            ->order(['Quotes.created' => 'DESC']);

        $quotes->where(['status !=' => 'paid']);
        $quotes->where(['status !=' => 'archived']);
        $quotes->where(['user_id' => $this->Auth->user('id')]);


        if ($search != null) {
            $quotes->where(['customer_name LIKE' => '%' . $search . '%']);
        }
        if ($status != null) {
            $quotes->where(['status' => $status]);
        }
        if ($status != 'expired') {
            $quotes->where(['status !=' => 'expired']);
        }


        $this->set(compact('quotes', 'search', 'status'));
        $this->set('_serialize', ['quotes', 'search', 'status']);
    }


    public function printout($id = null)
    {
        $quote = $this->Quotes->get($id, [
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
                'Cutsheets' => [
                    'sort' => ['id' => 'ASC']
                ],
                'Users' => function ($q) {
                    return $q->select(['username', 'avatar']);
                }
            ]
        ]);

        $deductions = TableRegistry::get('Mcvalues');
        if ($this->Auth->user('role') == 'manufacturer') {
            $deductions = $deductions->find('all')->where(['user_id' => $this->Auth->user('id')])->first();
        } else {
            $deductions = $deductions->find('all')->where(['user_id' => $this->Auth->user('parent_id')])->first();
        }


        $this->set(compact('quote', 'deductions'));
    }


    public function installsheet($id = null)
    {
        $this->printout($id);
    }


    public function cuttingschedule($id = null)
    {
        $this->printout($id);
    }


    public function invoice($id = null)
    {
        $this->authorize(['manufacturer', 'distributor', 'wholesaler', 'retailer']);

        $quote = $this->Quotes->get($id, [
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


        if ($this->request->is(['patch', 'post', 'put'])) {
            $quote = $this->Quotes->patchEntity($quote, $this->request->data);

            if ($this->Quotes->save($quote)) {
                $this->Flash->success(__('Invoice Updated.'));

            } else {
                $this->Flash->error(__('The inovice could not be updated. Please, try again.'));
            }
        }

        $fieldSettings = TableRegistry::get('Settings');
        $fieldSettings = $fieldSettings->find('all')->where(['user_id' => $this->Auth->user('id') , 'meta_key' => 'invoice-settings'])->first();
        $this->set(compact('quote', 'fieldSettings'));
        $this->set('_serialize', ['quote']);
    }

    public function funnelweb($id = null)
    {
        $this->printout($id);
    }


    /*** Manufacturers Orders Page (Displays All Orders) ***/

    public function orders()
    {
        $this->authorize(['manufacturer']);
        $search = null;
        $status = null;

        if (isset($this->request->query['search'])) {
            $search = $this->request->query['search'];
        }
        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
        }


        $quotes = $this->Quotes->find('all', ['contain' => [
            'Users' => function ($q) {
                return $q->select(['username']);
            }
        ]])
            //->order(['Quotes.created' => 'DESC']);
            ->order(['Quotes.created' => 'DESC', 'FIELD(Quotes.role, "wholesaler", "manufacturer") DESC']);//, 
         

        $quotes->where(['status !=' => 'pending']);
        $quotes->where(['status !=' => 'expired']);
        $quotes->where(['status !=' => 'archived']);
        

        $currentUserId = $this->Auth->user('id');
        $quotes->where(['OR' => [['Users.id' => $currentUserId], ['Users.parent_id' => $currentUserId]]]);


        if ($search != null) {
            $quotes->where(['customer_name LIKE' => '%' . $search . '%']);
        }
        if ($status != null) {
            $quotes->where(['status' => $status]);
        }


        $this->set(compact('quotes', 'search', 'status'));
        $this->set('_serialize', ['quotes', 'search', 'status']);
    }


    /**** Displays MF's All Quotes ****/
    public function myquotes()
    {
        $this->authorize(['manufacturer']);
        $search = null;
        $status = null;
        
        $fieldSettings = TableRegistry::get('Settings');
        $settings = $fieldSettings->find('all')
                        ->where(['user_id' => $this->Auth->user('id'), 'meta_key' => 'quote-draft'])->first();
        if($settings){
            
            $selected_fields = unserialize(base64_decode($settings->meta_value));
            if($this->saveQuote($selected_fields)){
                $fieldSettings->delete($settings);
            }            
        }
        
        if (isset($this->request->query['search'])) {
            $search = $this->request->query['search'];
        }
        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
        }

        $quotes = $this->Quotes->find('all', ['contain' => [
            'Users' => function ($q) {
                return $q->select(['username']);
            }
        ]])
            ->order(['Quotes.created' => 'DESC']);

        $quotes->where(['user_id' => $this->Auth->user('id')]);
        $quotes->where(['status !=' => 'archived']);

        if ($search != null) {
            $quotes->where(['customer_name LIKE' => '%' . $search . '%']);
        }
        if ($status != null) {
            $quotes->where(['status' => $status]);
        }
        if ($status != 'expired') {
            $quotes->where(['status !=' => 'expired']);
        } 
        


        $this->set(compact('quotes', 'search', 'status'));
        $this->set('_serialize', ['quotes', 'search', 'status']);
    }


    public function scheduler()
    {
        $this->authorize(['manufacturer']);

        $quotes = $this->Quotes->find('all', ['contain' => [
            'Users' => function ($q) {
                return $q->select(['username']);
            }
        ]])
            ->order(['Quotes.created' => 'DESC'])
            ->select(['Quotes.id', 'Quotes.customer_name', 'Quotes.status', 'Quotes.required_date', 'Quotes.orderin_date']);

        $quotes->where(['status !=' => 'pending']);
        $quotes->where(['status !=' => 'expired']);
        $currentUserId = $this->Auth->user('id');
        $quotes->where(['OR' => [['Users.id' => $currentUserId], ['Users.parent_id' => $currentUserId]]]);

        $this->set(compact('quotes'));
        $this->set('_serialize', ['quotes']);
    }


    public function roleselect()
    {
        $this->authorize(['manufacturer']);

        $options = [
            'distributor' => 'Distributor',
            'wholesaler' => 'Wholesaler',
            'retailer' => 'Retailer',
        ];

        if ($this->request->is('post')) {
            $mfrole = $this->request->data['role'];
            if ($mfrole) {
                $this->request->session()->write('mfrole', $mfrole);
                $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(_('Role is not selected'));
            }
        }

        $this->set(compact('options'));
        $this->set('_serialize', ['options']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->authorize(['manufacturer', 'distributor', 'wholesaler', 'retailer']);
        $role = $this->Auth->user('role');

        if ($role == 'manufacturer') {
            $mfrole = $this->request->session()->read('mfrole');
        }

        $quote = $this->Quotes->newEntity();

        if ($this->request->is('post')) {  
            

            $this->delete_blank_models($this->request->data);

            $quote = $this->Quotes->patchEntity($quote, $this->request->data, [
                'associated' =>
                    ['Products', 'Midrails', 'Additionalpermeters',
                        'Additionalperlength', 'Accessories', 'Customitems', 'Stockmetas', 'Cutsheets']
            ]);


            $quote->user_id = $this->Auth->user('id');
            $quote->role = $role;

            $ordered = false;
            $sendToInstaller = false;

            if ($this->request->data['is_ordered']) {
                $quote->status = 'in progress';
                $quote->orderin_date = (new \DateTime())->format('d/m/Y');
                $ordered = true;
            } else {
                $quote->status = 'pending';
            }

            if ($this->request->data['sendtoinstaller']) {
                $sendToInstaller = true;
            }

            $cal = new Calculator($quote, $this->Auth, $this->Quotes->Stockmetas);
            $stocks = $cal->calculatePrices();
                       
            if ($this->Quotes->save($quote)) {
                
                //$this->Quotes->Stockmetas->link($quote, $stocks);                

                if ($ordered) { // SEND EMAILS:
                    $this->orderplaced($quote, $sendToInstaller);
                }
                
                //Check if this Quote is autosaved, if yes then delete
                if ($this->request->data['draftid']){
                    $fieldSettings = TableRegistry::get('Settings');
                    $settings = $fieldSettings->find('all')
                        ->where(['user_id' => $this->Auth->user('id'),'meta_key' => 'quote-draft'])->first();
                    $fieldSettings->delete($settings);                   
                }
                                                
                $this->Flash->success(__('The quote has been saved.'));
                $this->request->session()->delete('mfrole');
                if ($this->Auth->user('role') == 'manufacturer') {
                    return $this->redirect(['action' => 'myquotes']);
                }
                return $this->redirect(['action' => 'index']);

            } else {
                $this->Flash->error(__('The quote could not be saved. Please, try again.'));
            }
        }


        $parts = TableRegistry::get('Parts');
        $dropdowns = TableRegistry::get('Dropdowns');
        $mcvaluesTable = TableRegistry::get('Mcvalues');
        $matrixTables = TableRegistry::get('Matrixtables');
        $installations = TableRegistry::get('Installations');




        $parts = $parts->find('all',['order' => 'display_order ASC',])->contain(['users_parts' => function ($q) {
            $role = $this->Auth->user('role');
            if ($role == 'manufacturer') {
                $userId = $this->Auth->user('id');
            } else {
                $userId = $this->Auth->user('parent_id');
            }
            return $q->where(['user_id' => $userId]);
        }]);

        $installation = $installations->find('all')->where(['user_id' => $this->Auth->user('id')])->first();


        if ($role == 'manufacturer') {
            $mcvalues = $mcvaluesTable->find('all')->where(['user_id' => $this->Auth->user('id')])->first();
            $matrixTables = $matrixTables->find('all',
                ['contain' => ['Prices' => function ($q) {
                    $userId = $this->Auth->user('id');
                    return $q->where(['user_id' => $userId]);
                }]]
            )->orderAsc('order_place');

            $dropdowns = $dropdowns->find('all')->where(['user_id' => $this->Auth->user('id')])->orderAsc('manual_sort');
        } else {
            $mcvalues = $mcvaluesTable->find('all')->where(['user_id' => $this->Auth->user('parent_id')])->first();
            $matrixTables = $matrixTables->find('all',
                ['contain' => ['Prices' => function ($q) {
                    $userId = $this->Auth->user('parent_id');
                    return $q->where(['user_id' => $userId]);
                }]]
            )->orderAsc('order_place');

            $dropdowns = $dropdowns->find('all')->where(['user_id' => $this->Auth->user('parent_id')])->orderAsc('manual_sort');
        }


        if (!$mcvalues) {
            $mcvalues = $mcvaluesTable->newEntity();
        }


        $this->set(compact('quote', 'parts', 'dropdowns', 'mcvalues', 'mfrole', 'matrixTables', 'installation'));
        //$this->set('_serialize', ['quote', 'parts', 'dropdowns', 'mcvalues', 'mfrole', 'matrixTables']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Quote id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->authorize(['manufacturer', 'distributor', 'wholesaler', 'retailer']);

        $quote = $this->Quotes->get($id, [
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
                'Cutsheets' => [
                    'sort' => ['id' => 'ASC']
                ]
            ]
        ]);

        $this->authorizeByModel($quote);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->delete_blank_models($this->request->data);

            $ordered = false;
            $isNew = false;
            $sendToInstaller = false;

            if ($this->request->data['is_copied']) {
                $isNew = true;
                $newQuote = $this->Quotes->newEntity();
                $newQuote = $this->Quotes->patchEntity($newQuote, $this->request->data, [
                    'associated' =>
                        ['Products', 'Midrails', 'Additionalpermeters',
                            'Additionalperlength', 'Accessories', 'Customitems', 'Cutsheets']
                ]);

                $newQuote->status = 'pending';
                $newQuote->user_id = $this->Auth->user('id');
                $newQuote->original_id = $quote->id;
                $newQuote->original_qid = $quote->qId;
                $quote = $newQuote;
            } else {
                $this->delete_associations($this->request->data, $quote);
                $oldStatus = $quote->status;
                $quote = $this->Quotes->patchEntity($quote, $this->request->data, [
                    'associated' =>
                        ['Products', 'Midrails', 'Additionalpermeters',
                            'Additionalperlength', 'Accessories', 'Customitems', 'Cutsheets'],
                    'Contain' => ['Stockmetas']
                ]);
                if ($this->Auth->user('role') != 'manufacturer') {
                    $quote->status = $oldStatus;
                }
            }


            if ($this->request->data['is_ordered'] && $this->request->data['is_ordered']!= 'false') {
                $quote->status = 'in progress';
                $quote->orderin_date = (new \DateTime())->format('d/m/Y');
                $ordered = true;
            }
            if ($this->request->data['sendtoinstaller']) {
                $sendToInstaller = true;
            }
                      

            $Stockmetas = TableRegistry::get('Stockmetas');
            $cal = new Calculator($quote, $this->Auth, $Stockmetas);
            $stocks = $cal->calculatePrices();


            //TODO Stocks both Edit and Add
            // if (!$isNew) {
            //     $stockId = $Stockmetas->find('all')->where(['quote_id' => $quote->id])->first()['stock_id'];
            //     foreach ($stocks as $stock) {
            //         $stock->stock_id = $stockId;
            //         $stock->quote_id = $quote->id;
            //     }
            // }
                        

            if ($this->Quotes->save($quote)) {
                if ($isNew) {
                    //$this->Quotes->Stockmetas->link($quote, $stocks);
                } else {
                    //$Stockmetas->deleteAll(['quote_id' => $quote->id]);
                    //$Stockmetas->saveMany($stocks);

                    if ($ordered) { //SEND EMAILS:
                        $this->orderplaced($quote, $sendToInstaller);
                    }
                }

                $this->Flash->success(__('The quote has been saved.'));

                if ($this->Auth->user('role') == 'manufacturer') {
                    return $this->redirect(['action' => 'myquotes']);
                }
                return $this->redirect(['action' => 'index']);

            } else {
                $this->Flash->error(__('The quote could not be saved. Please, try again.'));
            }
        }


        $parts = TableRegistry::get('Parts');
        $dropdowns = TableRegistry::get('Dropdowns');
        $mcvaluesTable = TableRegistry::get('Mcvalues');
        $installations = TableRegistry::get('Installations');
        $matrixTables = TableRegistry::get('Matrixtables');

        $installation = $installations->find('all')->where(['user_id' => $this->Auth->user('id')])->first();

        $parts = $parts->find('all')->contain(['users_parts' => function ($q) {
            $role = $this->Auth->user('role');
            if ($role == 'manufacturer') {
                $userId = $this->Auth->user('id');
            } else {
                $userId = $this->Auth->user('parent_id');
            }
            return $q->where(['user_id' => $userId]);
        }]);


        if ($this->Auth->user('role') == 'manufacturer') {
            $mcvalues = $mcvaluesTable->find('all')->where(['user_id' => $this->Auth->user('id')])->first();
            $matrixTables = $matrixTables->find('all',
                ['contain' => ['Prices' => function ($q) {
                    $userId = $this->Auth->user('id');
                    return $q->where(['user_id' => $userId]);
                }]]
            )->orderAsc('order_place');

            $dropdowns = $dropdowns->find('all')->where(['user_id' => $this->Auth->user('id')])->orderAsc('manual_sort');
        } else {
            $mcvalues = $mcvaluesTable->find('all')->where(['user_id' => $this->Auth->user('parent_id')])->first();
            $matrixTables = $matrixTables->find('all',
                ['contain' => ['Prices' => function ($q) {
                    $userId = $this->Auth->user('parent_id');
                    return $q->where(['user_id' => $userId]);
                }]]
            )->orderAsc('order_place');

            $dropdowns = $dropdowns->find('all')->where(['user_id' => $this->Auth->user('parent_id')])->orderAsc('manual_sort');
        }

        if (!$mcvalues) {
            $mcvalues = $mcvaluesTable->newEntity();
        }


        $this->set(compact('quote', 'parts', 'dropdowns', 'mcvalues', 'matrixTables', 'installation'));
    }


    public function markascomplete($id = null, $page = null)
    {
        $this->authorize(['manufacturer']);
        $this->request->allowMethod(['post', 'patch', 'put']);

        $quote = $this->Quotes->get($id, ['contain' => 'Users']);
        $quote->status = 'complete';

        if ($this->Quotes->save($quote)) {
            $this->sendEmail($quote->user->email, 'customer_order_completed', $quote);
            $this->Flash->success(__('The quote has been updated.'));
        } else {
            $this->Flash->error(__('The quote could not be updated. Please, try again.'));
        }

        return $this->redirect(['action' => $page]);
    }


    public function setquoted($id = null, $page = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $quote = $this->Quotes->get($id);

        if ($quote->quoted) {
            $quote->quoted = false;
        } else {
            $quote->quoted = true;
        }

        if ($this->Quotes->save($quote)) {
            $this->Flash->success(__('The quote has been updated.'));
        } else {
            $this->Flash->error(__('The quote could not be updated. Please, try again.'));
        }

        return $this->redirect(['action' => $page]);
    }


    public
    function setprinted($id = null, $page = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $quote = $this->Quotes->get($id);

        if ($quote->printed) {
            $quote->printed = false;
        } else {
            $quote->printed = true;
        }

        if ($this->Quotes->save($quote)) {
            $this->Flash->success(__('The quote has been updated.'));
        } else {
            $this->Flash->error(__('The quote could not be updated. Please, try again.'));
        }

        return $this->redirect(['action' => $page]);
    }

    public
    function markasexpired($id = null, $page = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $quote = $this->Quotes->get($id);

        $quote->status = 'expired';

        if ($this->Quotes->save($quote)) {
            $this->Flash->success(__('The quote has been marked as expired.'));
        } else {
            $this->Flash->error(__('The quote could not be updated. Please, try again.'));
        }

        return $this->redirect(['action' => $page]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Quote id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public
    function delete($id = null, $page = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quote = $this->Quotes->get($id);
        
        $quote->status = 'archived';
        if ($this->Quotes->save($quote)) {
            $this->Flash->success(__('The quote has been deleted.'));
        } else {
            $this->Flash->error(__('The quote could not be deleted. Please, try again.'));
        }
        
        /*if ($page == 'myquotes') {
            $quote->status = 'archived';
            //if ($this->Quotes->delete($quote)) {
            if ($this->Quotes->save($quote)) {
                $this->Flash->success(__('The quote has been deleted.'));
            } else {
                $this->Flash->error(__('The quote could not be deleted. Please, try again.'));
            }
        } elseif ($page == 'orders') {
            
            if ($quote->user_id == $this->Auth->user('id')) {
                //if ($this->Quotes->delete($quote)) {
                $quote->status = 'archived';
                if ($this->Quotes->save($quote)) {
                    $this->Flash->success(__('The quote has been deleted.'));
                } else {
                    $this->Flash->error(__('The quote could not be deleted. Please, try again.'));
                }
            } else {
                $quote->status = 'archived';
                if ($this->Quotes->save($quote)) {
                    $this->Flash->success(__('The quote has been deleted.'));
                }
            }
        }*/

        return $this->redirect(['action' => $page]);
    }


    private
    function delete_blank_models($data)
    {

        $associates = [
            'products',
            //'midrails',
            'additionalpermeters',
            'additionalperlength',
            'accessories',
            'customitems',
            'cutsheets',
        ];

        foreach ($associates as $associated) {
            $hasValue = false;
            $i = 0;
            foreach ($data[$associated] as $associate) {
                foreach ($associate as $key => $value) {
                    if ($key != 'custom_tick' && $key != 'product_emergency_window' && !empty($value) && !$this->strictEmpty($value) && $value != null) {
                        //debug($key);
                        $hasValue = true;
                    }
                }
                if (!$hasValue) {
                    unset($this->request->data[$associated][$i]);
                }
                $i++;
                $hasValue = false;
            }
        }
    }


    private function strictEmpty($var) {

        $var = trim($var);

        if(isset($var) === true && $var === '') {

            return true;

        }

        return false;
    }


    private
    function delete_associations($data, $quote)
    {
        $product_ids = $data['products_to_delete'];
        $midrail_ids = $data['midrails_to_delete'];
        $additional_m_ids = $data['additional_m_to_delete'];
        $customitem_ids = $data['customitems_to_delete'];
        $cutsheet_ids = $data['cutsheets_to_delete'];

        $product_ids = (explode(',', $product_ids));
        $midrail_ids = (explode(',', $midrail_ids));
        $additional_m_ids = (explode(',', $additional_m_ids));
        $customitem_ids = (explode(',', $customitem_ids));
        $cutsheet_ids = (explode(',', $cutsheet_ids));


        $products = [];
        $midrails = [];
        $additionals = [];
        $customitems = [];
        $cutsheets = [];

        /*****************************************************/

        foreach ($product_ids as $product_id) {
            if (!empty($product_id)) {
                $products[] = $this->Quotes->Products->get($product_id);
            }
        }
        $this->Quotes->Products->unlink($quote, $products);

        /*****************************************************/

        foreach ($midrail_ids as $midrail_id) {
            if (!empty($midrail_id)) {
                $midrails[] = $this->Quotes->Midrails->get($midrail_id);
            }
        }
        $this->Quotes->Midrails->unlink($quote, $midrails);

        /*****************************************************/

        foreach ($additional_m_ids as $additional_m_id) {
            if (!empty($additional_m_id)) {
                $additionals[] = $this->Quotes->Additionalpermeters->get($additional_m_id);
            }
        }
        $this->Quotes->Additionalpermeters->unlink($quote, $additionals);

        /*****************************************************/

        foreach ($customitem_ids as $customitem_id) {
            if (!empty($customitem_id)) {
                $customitems[] = $this->Quotes->Customitems->get($customitem_id);
            }
        }
        $this->Quotes->Customitems->unlink($quote, $customitems);

        /*****************************************************/

        /*****************************************************/

        foreach ($cutsheet_ids as $cutsheet_id) {
            if (!empty($cutsheet_id)) {
                $cutsheets[] = $this->Quotes->Cutsheets->get($cutsheet_id);
            }
        }
        $this->Quotes->Cutsheets->unlink($quote, $cutsheets);

        /*****************************************************/
    }


    private function orderplaced($quote, $sendToInstaller)
    {
        $role = $this->Auth->user('role');
        if ($role == 'manufacturer') {
            $this->sendEmail($this->Auth->user('email'), 'mf_order_placed', $quote);
        } else {
            // Get Parent MF User Email Address:
            $mfemail = $this->Quotes->Users->get($this->Auth->user('parent_id'))['email'];
            $this->sendEmail($mfemail, 'mf_order_placed', $quote);
            $this->sendEmail($this->Auth->user('email'), 'customer_order_placed', $quote);
        }

        if ($sendToInstaller) {
            if ($role == 'manufacturer') {
                $mail = $this->Quotes->Users->find('all')
                    ->where(['parent_id' => $this->Auth->user('id')])
                    ->where(['role' => 'installer'])->first()['email'];
            } else {
                $mail = $this->Quotes->Users->find('all')
                    ->where(['parent_id' => $this->Auth->user('parent_id')])
                    ->where(['role' => 'installer'])->first()['email'];
            }
            $this->sendEmail($mail, 'installer_order_placed', $quote);
        }
    }
    
    function sendattachment()
    {
        $this->autoRender = false;
        $result['response'] = true;
        
        if (!empty($this->request->data['file']['tmp_name'])) {
            //upload manufacturer file
            $file_name = $this->request->data['file']['name'];
            $folder_url = WWW_ROOT . 'assets' . DS. 'attachments' . DS . 'manufacturer' . DS ;
            
            if (move_uploaded_file($this->request->data['file']['tmp_name'], $folder_url . $file_name)) {
                $id = $this->request->query['quote_id'];
                $quote = $this->Quotes->get($id, ['contain' => 'Users']);
                
                $role = $this->Auth->user('role');
                $quote->attachment = $folder_url . $file_name;
                if ($role == 'manufacturer') {
                    $this->sendEmail($this->Auth->user('email'), 'mf_attachment', $quote);
                } else {
                    // Get Parent MF User Email Address:
                    $mfemail = $this->Quotes->Users->get($this->Auth->user('parent_id'))['email'];
                    $this->sendEmail($mfemail, 'mf_attachment', $quote);                    
                }
                $result['message'] = 'File sent to manufacturer.';                
            }
        } else {
            $result['response'] = false;  
            $result['message'] = 'Please attache a file.';
        }
        
        echo json_encode($result);
        exit;
    }
    function saveQuote($data){
        
        //$this->authorize(['manufacturer', 'distributor', 'wholesaler', 'retailer']);
        $role = $this->Auth->user('role');
        $quote = $this->Quotes->newEntity();

        $this->request->data = $data;
        $this->delete_blank_models($this->request->data);

        $quote = $this->Quotes->patchEntity($quote, $this->request->data, [
            'associated' =>
                ['Products', 'Midrails', 'Additionalpermeters',
                    'Additionalperlength', 'Accessories', 'Customitems', 'Stockmetas', 'Cutsheets']
        ]);


        $quote->user_id = $this->Auth->user('id');
        $quote->role = $role;

        $ordered = false;
        $sendToInstaller = false;

        if ($this->request->data['is_ordered']) {
            $quote->status = 'in progress';
            $quote->orderin_date = (new \DateTime())->format('d/m/Y');
            $ordered = true;
        } else {
            $quote->status = 'pending';
        }       

        $cal = new Calculator($quote, $this->Auth, $this->Quotes->Stockmetas);
        $stocks = $cal->calculatePrices();

        if ($this->Quotes->save($quote)) {            
            return true;
        } else {
            return false;
        }
        
    }
    function autosavequote() {
        
        $this->autoRender = false;
        $result['response'] = true;
        
        $fieldSettings = TableRegistry::get('Settings');
        $settings = $fieldSettings->find('all')
                        ->where(['user_id' => $this->Auth->user('id'),'meta_key' => 'quote-draft'])->first();
        if(empty($settings)){
            $settings = $fieldSettings->newEntity();
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {            
            $settings = $fieldSettings->patchEntity($settings, $this->request->data);
            $settings->user_id = $this->Auth->user('id');
            $settings->meta_key = 'quote-draft';
            $settings->meta_value = base64_encode(serialize($this->request->data));
            if ($fieldSettings->save($settings)) {
                $result['result'] = true;
                $result['id'] = $settings->id;
                $result['message'] = 'The quote has been saved.';
            } else {
                $result['result'] = false;  
                $result['message'] = 'The quote could not be saved. Please, try again.';
            }
        }
        echo json_encode($result);
        exit;
    }
    
    public function monthlyReport($user_id = null)
    {
        $month = date('m');
        $year = date('Y');
        
        $quotes = $this->Quotes->find('all', ['contain' => [
            'Users' => function ($q) {
                return $q->select(['business_name']);
            }
        ]])
            ->order(['Quotes.orderin_date' => 'DESC', 'FIELD(Quotes.role, "wholesaler", "manufacturer") DESC']);//, 

         $users = TableRegistry::get('Users');
         $userIds = $users->find('list', ['keyField' => 'id', 'valueField' => 'id'])
                ->where(['Users.parent_id' => $user_id]);

         $userIds = $userIds->toArray();
         array_push($userIds, $user_id);
         
         
        $quotes->where(['Quotes.user_id IN ' => $userIds]);
        
        $quotes->andWhere(function ($exp) {
                return $exp->or_([
                    'Quotes.status' => 'complete',
                    ]);
                });
         
        $quotes->orWhere(['Quotes.status' => 'in progress']);
        
               
        if (isset($this->request->query['month'])) {
            $month = $this->request->query['month'];
        }
        if (isset($this->request->query['year'])) {
            $year = $this->request->query['year'];
        }
        
        $quotes->where(['date_format(str_to_date(`Quotes`.`orderin_date`, "%d/%m/%Y"), "%m") = '. $month]);
        $quotes->where(['date_format(str_to_date(`Quotes`.`orderin_date`, "%d/%m/%Y"), "%Y")='. $year]);
      
        
        $this->set(compact('quotes', 'search', 'status', 'user_id', 'month', 'year'));
        $this->set('_serialize', ['quotes', 'search', 'status', 'user_id', 'month', 'year']);
    }
}
