<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use CakePdf\Pdf\CakePdf;

/**
 * Matrixtables Controller
 *
 * @property \App\Model\Table\MatrixtablesTable $Matrixtables
 */
class MatrixtablesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        if ($this->Auth->user()) {
            $this->Auth->allow([
                'edittable',
                'tableselect',
                'uploadcsv',
                'pdfexport'
            ]);
        }

    }


    public function tableselect()
    {
        $this->authorize(['manufacturer']);

        $tables = $this->Matrixtables->find('all')->select(['name', 'id'])->orderAsc('order_place');
        $this->set('tables', $tables);
    }




    public function uploadcsv()
    {
        $this->authorize(['manufacturer']);
        $tableId = $this->request->data['tableId'];
        if ($this->request->is('post')) {
            if (!empty($this->request->data['file']['name'])) {
                $fileName = $this->request->data['file']['tmp_name'];
                $table = $this->Matrixtables->get($tableId,
                    ['contain' => ['Prices' => function ($q) {
                        $userId = $this->Auth->user('id');
                        return $q->where(['user_id' => $userId]);
                    }]]
                );


                $matrixArr = null;
                try {
                    $contents = file_get_contents($fileName);
                    $lines = explode(PHP_EOL, $contents);
                    $matrixArr = $this->generateMatrixArrByCsv($lines);
                } catch (Exception $e) {
                    $matrixArr = null;
                }

                if ($matrixArr == null) {
                    $this->Flash->error('The CSV file is not valid.');
                    return $this->redirect(['action' => 'edittable', $tableId]);
                }

                $entity = $this->Matrixtables->Prices->find('all')
                    ->where(['user_id' => $this->Auth->user('id')])
                    ->where(['matrixtable_id' => $tableId])->first();

                if (!$entity) {
                    $entity = $this->Matrixtables->Prices->newEntity();
                }


                $entity->user_id = $this->Auth->user('id');
                $entity->matrixtable_id = $tableId;
                $entity->pricePerMesure = json_encode($matrixArr);


                if ($this->Matrixtables->Prices->link($table, [$entity])) {
                    $this->Flash->success('Values were updated successfully.');
                } else {
                    $this->Flash->error('Values cannot be updated, Please try again.');
                }
                return $this->redirect(['action' => 'edittable', $tableId]);
            }
        }
        $this->Flash->error('No file chosen, Please select a .csv file.');
        return $this->redirect(['action' => 'edittable', $tableId]);
    }



    public function pdfexport($id = null)
    {
        $this->authorize(['manufacturer']);

        $table = $this->Matrixtables->get($id,
            ['contain' => ['Prices' => function ($q) {
                $userId = $this->Auth->user('id');
                return $q->where(['user_id' => $userId]);
            }]]
        );

        $this->viewBuilder()->options([
            'pdfConfig' => [
                'filename' => $table->name . '.pdf',
                'orientation' => 'landscape',
            ]
        ]);
        $this->set('table', $table);
    }


    public function edittable($id = null)
    {
        $this->authorize(['manufacturer']);
        if (isset($this->request->query['id'])) {
            $tableId = $this->request->query['id'];
        } else {
            $tableId = $id;
        }

        $userId = $this->Auth->user('id');

        if (!is_numeric($tableId)) {
            $this->Flash->error(__('Table ID was not specified, Please try again.'));
            return $this->redirect(['action' => 'tableselect']);
        }


        $table = $this->Matrixtables->get($tableId,
            ['contain' => ['Prices' => function ($q) {
                $userId = $this->Auth->user('id');
                return $q->where(['user_id' => $userId]);
            }]]
        );


        if ($this->request->is(['patch', 'post', 'put'])) {

            $dataArr = null;
            $filteredArr = [];
            if (isset($this->request->data['data'])) {
                $rawData = $this->request->data['data'];
                $dataArr = json_decode($rawData);
            }


            if ($dataArr) {
                foreach ($dataArr as $obj) {
                    if (in_array($obj->width, json_decode($table->widths))) {
                        $filteredArr[] = $obj;
                    }
                }
            }


            $entity = $this->Matrixtables->Prices->find('all')
                ->where(['user_id' => $userId])
                ->where(['matrixtable_id' => $tableId])->first();

            if (!$entity) {
                $entity = $this->Matrixtables->Prices->newEntity();
            }


            $entity->user_id = $this->Auth->user('id');
            $entity->matrixtable_id = $tableId;
            $entity->pricePerMesure = json_encode($filteredArr);


            if ($this->Matrixtables->Prices->link($table, [$entity])) {
                $this->Flash->success('Master Calculator values has been updated.');
                return $this->redirect(['action' => 'edittable', $tableId]);
            } else {
                $this->Flash->error('Master Calculator values cannot be updated, Please try again.');
            }
        }


        $this->set('table', $table);
    }


    private function generateMatrixArrByCsv($lines)
    {
        $widths = [];
        $rows = [];
        $index = 0;
        while (count($widths) == 0) {
            for ($i = 0; $i < count($lines); $i++) {
                if ($i == $index) {
                    $widths = array_filter(str_getcsv($lines[$i]), function ($item) {
                        return is_numeric($item);
                    });

                    //Re index array from 0
                    $widths = array_values($widths);
                    break;
                }
            }
            $index++;
        }

        for ($i = $index; $i < count($lines); $i++) {
            $rows[] = array_filter(str_getcsv($lines[$i]), function ($item) {
                return is_numeric($item);
            });
        }

        $finalArr = [];
        foreach ($rows as $row) {
            $h = 0;
            for ($i = 0; $i < count($row); $i++) {
                $row = array_values($row);
                if ($i == 0) {
                    $h = $row[$i];
                } else {
                    if (isset($row[$i]) && isset($widths[$i - 1])) {
                        $price = $row[$i];
                        $w = $widths[$i - 1];
                        $finalArr[] = ['price' => $price, 'width' => $w, 'height' => $h];
                    }
                }
            }
        }
        if (count($finalArr) > 0) {
            return $finalArr;
        }
        return null;
    }
}
