<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null)
 */
class ProductsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('products');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Quotes', [
            'foreignKey' => 'quote_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
//        $validator
//            ->integer('id')
//            ->allowEmpty('id', 'create');
//
//        $validator
//            ->allowEmpty('product_item_number');
//
        $validator
            ->integer('product_qty')
            ->allowEmpty('product_qty');
//
//        $validator
//            ->allowEmpty('product_sec_dig_perf_fibr');
//
//        $validator
//            ->allowEmpty('product_316_ss_gal_pet');
//
//        $validator
//            ->allowEmpty('product_window_or_door');
//
//        $validator
//            ->allowEmpty('product_emergency_window');
//
//        $validator
//            ->allowEmpty('product_window_frame_type');
//
//        $validator
//            ->allowEmpty('product_configuration');
//
//        $validator
//            ->allowEmpty('product_location_in_building');
//
        $validator
            ->integer('product_width')
            ->allowEmpty('product_width');
//
        $validator
            ->integer('product_height')
            ->allowEmpty('product_height');
//
//        $validator
//            ->allowEmpty('product_number_of_locks');
//
//        $validator
//            ->allowEmpty('product_lock_type');
//
//        $validator
//            ->allowEmpty('product_lock_handle_height');



        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['quote_id'], 'Quotes'));

        return $rules;
    }
}
