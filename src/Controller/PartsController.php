<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Core\Exception\Exception;

/**
 * Parts Controller
 *
 * @property \App\Model\Table\PartsTable $Parts
 */
class PartsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow(['index', 'add', 'edit', 'delete', 'selectmf', 'all', 'factoryedit', 'factorydelete', 'uploadcsv','custompartsdefine']);
        }
    }


    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Include the FlashComponent

        $this->viewBuilder()->layout('pantherpro-in');
    }

    public function selectmf()
    {
        $this->authorize(['supplier']);

        $users = TableRegistry::get('Users');
        $mfs = $users->find('all')->where(['role' => 'manufacturer'])->select(['id', 'username']);
        $this->set('mfs', $mfs);
    }


    public function all()
    {
        $this->authorize(['supplier']);

        $parts = $this->Parts->find('all')->orderAsc('title');

        $filterby = null;
        if (isset($this->request->query['filterby'])) {
            $filterby = $this->request->query['filterby'];
            switch ($filterby) {
                case 'mc':
                    $parts->where(['Parts.master_calculator_value' => true]);
                    break;
                case 'permeters':
                    $parts->where(['Parts.show_in_additional_section_dropdown' => true]);
                    break;
                case 'perlengths':
                    $parts->where(['Parts.show_in_additional_section_by_length_dropdown' => true]);
                    break;
                case 'accesories':
                    $parts->where(['Parts.show_in_accessories_dropdown' => true]);
                    break;
            }
        }

        $this->set(compact('parts', 'filterby'));
    }


    public function index()
    {
        $this->authorize(['supplier', 'manufacturer']);
        $role = $this->Auth->user('role');
        $search = null;
        
        if (isset($this->request->query['search'])) {
            $search = $this->request->query['search'];
        }

        $mf = $this->request->query('mf');
        $UserPart = TableRegistry::get('users_parts');
		$userparts = TableRegistry::get('parts');
		$id = $this->Auth->user('id');
		$usersPartID = $UserPart->find('all')->where(['user_id' => $mf]);
        $parts = null;
        if ($role == 'supplier') {
            $parts = $userparts->find('all')->contain(['users_parts'])->orderAsc('parts.display_order');
		} elseif ($role == 'manufacturer') {
            $parts = $UserPart->find('all')->where(['user_id' => $id])->contain(['Parts'])->orderAsc('Parts.display_order');
        }
        $parts->orderAsc('title');

        $this->set(compact('parts', 'filterby'));

        $filterby = null;
        if (isset($this->request->query['filterby'])) {
            $filterby = $this->request->query['filterby'];
            switch ($filterby) {
                case 'mc':
                    $parts->where(['Parts.master_calculator_value' => true]);
                    break;
                case 'permeters':
                    $parts->where(['Parts.show_in_additional_section_dropdown' => true]);
                    break;
                case 'perlengths':
                    $parts->where(['Parts.show_in_additional_section_by_length_dropdown' => true]);
                    break;
                case 'accesories':
                    $parts->where(['Parts.show_in_accessories_dropdown' => true]);
                    break;
            }
        }
        
        if ($search != null) {
            $parts->where(['OR' => [
                    'title LIKE' => '%' . $search . '%', 
                    'part_code LIKE' => '%' . $search . '%',
                    'part_number LIKE' => '%' . $search . '%',
                    'supplier LIKE' => '%' . $search . '%'
                ]
            ]);
        }


        $this->set(compact('parts', 'filterby', 'mf', 'search', 'usersPartID','role'));
    }

    /**
     * View method
     *
     * @param string|null $id Part id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $part = $this->Parts->get($id);
        $this->set(compact('part'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->authorize(['supplier']);

        $part = $this->Parts->newEntity();

        if ($this->request->is('post')) {
            $part = $this->Parts->patchEntity($part, $this->request->data);
            $userparts = TableRegistry::get('users_parts');
            $users = TableRegistry::get('users');
            $mfs = $users->find('all')->where(['role' => 'manufacturer']);


            if ($this->Parts->save($part)) {
                $entities = [];
                foreach ($mfs as $mf) {
                    $entity = $userparts->newEntity();
                    $entity->buy_price_include_GST = $part->buy_price_include_GST;
                    $entity->mark_up = $part->mark_up;
                    $entity->marked_up = $part->mark_up;
                    $entity->price_per_unit = $part->price_per_unit;
                    $entity->user_id = $mf->id;
                    $entity->part_id = $part->id;
                    $entity->show_in_additional_section_dropdown = $part->show_in_additional_section_dropdown;
                    $entity->show_in_additional_section_by_length_dropdown = $part->show_in_additional_section_by_length_dropdown;
                    $entity->show_in_accessories_dropdown = $part->show_in_accessories_dropdown;
                    $entity->master_calculator_value = $part->master_calculator_value;
                    $entities[] = $entity;
                }

                if ($userparts->saveMany($entities)) {
                    $this->Flash->success(__('New part has been saved.'));
                    return $this->redirect(['action' => 'all']);
                }
            }
            $this->Flash->error(__('Unable to add a new part.'));
        }
        $this->set('part', $part);
    }

    /**
     * Edit method
     *
     * @param string|null $id Part id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->authorize(['supplier', 'manufacturer']);
        $role = $this->Auth->user('role');
        $userparts = TableRegistry::get('users_parts');
		$parts = TableRegistry::get('parts');
        		
		if($role == 'supplier'){
			$part = $parts->find('all')->where(['id' => $id])->contain(['users_parts'])->first();
			if ($this->request->is(['post', 'put'])) {
				$parts->patchEntity($part, $this->request->data);
				if ($parts->save($part)) {
					$this->Flash->success(__('Your part has been updated.'));
					if ($role == 'supplier') {
						return $this->redirect(['action' => 'index', 'mf' => $part->user_id]);
					}
					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('Unable to update your part.'));
			}
		}
		if($role == 'manufacturer'){
			//$part = $parts->find('all')->where(['id' => $id])->contain(['users_parts'])->first();
            $part = $userparts->find('all')->where(['part_id' => $id])->contain(['Parts'])->first();
			if ($this->request->is(['post', 'put'])) {
				$userparts->patchEntity($part, $this->request->data);
				if ($userparts->save($part)) {
					$this->Flash->success(__('Your part has been updated.'));
					if ($role == 'supplier') {
						return $this->redirect(['action' => 'index', 'mf' => $part->user_id]);
					}
					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('Unable to update your part.'));
			}
		}
        //$this->set('part', $part);
		$this->set(compact('part','role'),$part);
    }


    public function factoryedit($id = null)
    {
        $this->authorize(['supplier']);
        $part = $this->Parts->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Parts->patchEntity($part, $this->request->data);
            if ($this->Parts->save($part)) {
                $this->Flash->success(__('Your part has been updated.'));
                return $this->redirect(['action' => 'all']);
            }
            $this->Flash->error(__('Unable to update your part.'));
        }

        $this->set('part', $part);
    }

    /**
     * Delete method
     *
     * @param string|null $id Part id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function delete($id = null)
    {
        $this->authorize(['supplier', 'manufacturer']);
        $this->request->allowMethod(['post', 'delete']);
		$users_parts = TableRegistry::get('users_parts');
		//$part = $users_parts->find('all')->where(['id' => $id]);
        $part = $users_parts->get($id);
        if ($users_parts->delete($part)) {
            $this->Flash->success(__('The user part with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'all']);
        }


		/*$role = $this->Auth->user('role');
		$partsTable = TableRegistry::get('parts');
		$part = $partsTable->find('all')->where(['id' => $id])->contain(['users_parts'])->first();
		
        if ($partsTable->delete($part)) {
            $this->Flash->success(__('The part has been deleted.'));
            if ($role == 'supplier') {
                return $this->redirect(['action' => 'index', 'mf' => '47']);
            }
            return $this->redirect(['action' => 'index']);
        }*/
    }


    public function factorydelete($id = null)
    {
        $this->authorize(['supplier']);
        $this->request->allowMethod(['post', 'delete']);
		$role = $this->Auth->user('role');
		$partsTable = TableRegistry::get('parts');
		$part = $partsTable->find('all')->where(['id' => $id])->contain(['users_parts'])->first();

		if ($partsTable->delete($part)) {
            $this->Flash->success(__('The part with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'all']);
        }
        /*$part = $this->Parts->get($id);
        if ($this->Parts->delete($part)) {
            $this->Flash->success(__('The part with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'all']);
        }*/

    }
	public function custompartsdefine()
	{
		$this->authorize(['supplier']);
		$userparts = TableRegistry::get('parts');
		$users_parts = TableRegistry::get('users_parts');
		if ($this->request->is('post')) {
			$parts = $userparts->find('all')->where(['id IN ' => $this->request->data['userParts']]);
			$users = $users_parts->find('all')->where(['user_id' => $this->request->data['userID']]);
			$partsIDs = [];
			$usersID = [];
			foreach($users as $usersIDs){
				$usersID[] = $usersIDs->user_id;
				$partsIDs[] = $usersIDs->part_id;
			}
			if(!empty($usersID)){
				$users_parts->deleteAll(['user_id IN' => $usersID]);
			}
			$entities = [];
			foreach ($parts as $part) {
				$entity = $users_parts->newEntity();
				$entity->buy_price_include_GST = $part->buy_price_include_GST;
				$entity->unit = $part->unit;
				$entity->size = $part->size;
				$entity->mark_up = $part->mark_up;
				$entity->marked_up = $part->marked_up;
				$entity->price_per_unit = $part->price_per_unit;
				$entity->user_id = $this->request->data['userID'];
				$entity->part_id = $part->id;
				$entity->description = $part->description;
				$entity->show_in_additional_section_dropdown = $part->show_in_additional_section_dropdown;
				$entity->show_in_additional_section_by_length_dropdown = $part->show_in_additional_section_by_length_dropdown;
				$entity->show_in_accessories_dropdown = $part->show_in_accessories_dropdown;
				$entity->master_calculator_value = $part->master_calculator_value;
				$entity->display_order = $part->display_order;
				$entities[] = $entity;
			}
			if (!$users_parts->saveMany($entities)) {
				$this->Flash->error(__('MF Parts could not be updated, Please try again.'));
			}
			return $this->redirect(['action' => 'index', 'mf' => $this->request->data['userID']]);
		}
	}
    public function uploadcsv()
    {
        $this->authorize(['supplier']);
		
        $parts = null;
        if ($this->request->is('post')) {
            if (!empty($this->request->data['file']['name'])) {
                $fileName = $this->request->data['file']['tmp_name'];
                try {
                    $contents = file_get_contents($fileName);
                    $lines = explode(PHP_EOL, $contents);
                    $parts = $this->generatePartsArray($lines);
                } catch (Exception $e) {
                    $parts = null;
                }

                if (is_array($parts)) {
					//die(debug($parts));
                    $entities = [];
                    foreach ($parts as $part) {
                        if (isset($part[1]) && !$this->strictEmpty($part[1])) {
                            $entity = $this->Parts->newEntity();
                            $entity->part_code = isset($part[0]) ? $part[0] : '';
                            $entity->title = isset($part[1]) ? $part[1] : '';
                            $entity->part_number = isset($part[2]) ? $part[2] : '';
                            $entity->supplier = isset($part[3]) ? $part[3] : '';
                            $entity->buy_price_include_GST = isset($part[4]) ? $part[4] : 0;
                            $entity->unit = isset($part[5]) ? $part[5] : '';
                            $entity->size = isset($part[6]) ? $part[6] : 0;
                            $entity->mark_up = isset($part[7]) ? $part[7] : 0;
                            $entity->marked_up = isset($part[8]) ? $part[8] : 0;
                            $entity->price_per_unit = isset($part[9]) ? $part[9] : 0;
                            $entity->description = isset($part[11]) ? $part[11] : '';
                            $entity->display_order = isset($part[12]) ? $part[12] : '';

                            if (isset($part[10])) {
                                if ($part[10] == 'adm') {
                                    $entity->show_in_additional_section_dropdown = true;
                                } else if ($part[10] == 'adl') {
                                    $entity->show_in_additional_section_by_length_dropdown = true;
                                } else if ($part[10] == 'ac') {
                                    $entity->show_in_accessories_dropdown = true;
                                } else if ($part[10] == 'mc') {
                                    $entity->master_calculator_value = true;
                                }
                            }
                            $entities[] = $entity;
                        }
                    }

                    if (isset($this->request->data['deleteall']) && $this->request->data['deleteall'] == 1) {
                        $this->Parts->deleteAll([]);
                    }
                    if ($this->Parts->saveMany($entities)) {
                        //$this->updateAllMfsParts($entities);
                        $this->Flash->success(__('The CSV file has been successfully imported.'));
                        return $this->redirect(['action' => 'all']);
                    }
                }
            }
        }
        $this->Flash->error(__('Invalid CSV file, Please try again.'));
        return $this->redirect(['action' => 'all']);
    }

    private function generatePartsArray($lines)
    {

        $finalArr = [];
        $i = 0;
        foreach ($lines as $line) {
            if ($i > 0) {
                $finalArr[] = str_getcsv($line);
            }
            $i++;
        }
        if (count($finalArr) > 0) {
            return $finalArr;
        }
        return null;
    }


    private function updateAllMfsParts($parts)
    {
        $userparts = TableRegistry::get('users_parts');
        $users = TableRegistry::get('users');

        $mfs = $users->find('all')->where(['role' => 'manufacturer']);

        $entities = [];
        foreach ($parts as $part) {

            foreach ($mfs as $mf) {
                $entity = $userparts->newEntity();
                $entity->buy_price_include_GST = $part->buy_price_include_GST;
                $entity->mark_up = $part->mark_up;
                $entity->marked_up = $part->marked_up;
                $entity->price_per_unit = $part->price_per_unit;
                $entity->user_id = $mf->id;
                $entity->part_id = $part->id;
                $entity->description = $part->description;
                $entity->show_in_additional_section_dropdown = $part->show_in_additional_section_dropdown;
                $entity->show_in_additional_section_by_length_dropdown = $part->show_in_additional_section_by_length_dropdown;
                $entity->show_in_accessories_dropdown = $part->show_in_accessories_dropdown;
                $entity->master_calculator_value = $part->master_calculator_value;
                $entity->display_order = $part->display_order;
                $entities[] = $entity;
            }
        }

        if (!$userparts->saveMany($entities)) {
            $this->Flash->error(__('MF Parts could not be updated, Please try again.'));
        }
    }


    private function strictEmpty($var) {

        $var = trim($var);

        if(isset($var) === true && $var === '') {

            return true;

        }

        return false;
    }


}
