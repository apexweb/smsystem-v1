<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Quotes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Originals
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Quote get($primaryKey, $options = [])
 * @method \App\Model\Entity\Quote newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Quote[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Quote|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Quote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Quote[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Quote findOrCreate($search, callable $callback = null)
 */
class QuotesTable extends Table
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

        $this->table('quotes');
        $this->displayField('customer_name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');


        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);


        $this->hasMany('Products', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);

        $this->hasMany('Midrails', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);

        $this->hasMany('Additionalpermeters', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);

        $this->hasMany('Additionalperlength', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);

        $this->hasMany('Accessories', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);

        $this->hasMany('Customitems', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);

        $this->hasMany('Stockmetas', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
        ]);
        $this->hasMany('Cutsheets', [
            'foreignKey' => 'quote_id',
            'dependent' => true,
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
//            ->allowEmpty('order_date');
//
//        $validator
//            ->allowEmpty('required_date');
//
//        $validator
//            ->allowEmpty('orderin_date');
//
//        $validator
//            ->allowEmpty('notes');
//
//        $validator
//            ->allowEmpty('notes2');
//
//        $validator
//            ->allowEmpty('notes3');
//
//        $validator
//            ->allowEmpty('customer_name');
//
//        $validator
//            ->allowEmpty('mobile');
//
//        $validator
//            ->allowEmpty('phone');
//
//        $validator
//            ->email('email')
//            ->allowEmpty('email');
//
//        $validator
//            ->allowEmpty('fax');
//
//        $validator
//            ->allowEmpty('street');
//
//        $validator
//            ->allowEmpty('suburb');
//
//        $validator
//            ->allowEmpty('postcode');
//
//        $validator
//            ->allowEmpty('standard');
//
//        $validator
//            ->requirePresence('second_color_required', 'create')
//            ->notEmpty('second_color_required');
//
//        $validator
//            ->allowEmpty('color1');
//
//        $validator
//            ->allowEmpty('color2');
//
//        $validator
//            ->allowEmpty('color3');
//
//        $validator
//            ->allowEmpty('color4');
//
//        $validator
//            ->allowEmpty('standard_color');
//
//        $validator
//            ->allowEmpty('color1_color');
//
//        $validator
//            ->allowEmpty('color2_color');
//
//        $validator
//            ->allowEmpty('color3_color');
//
//        $validator
//            ->allowEmpty('color4_color');
//
//        $validator
//            ->allowEmpty('installation_required');
//
//        $validator
//            ->integer('additional_installation_amount')
//            ->allowEmpty('additional_installation_amount');
//
//        $validator
//            ->integer('status')
//            ->requirePresence('status', 'create')
//            ->notEmpty('status');
//
//        $validator
//            ->allowEmpty('count_additional');
//
//        $validator
//            ->allowEmpty('freight_cost');
//
//        $validator
//            ->requirePresence('notes4', 'create')
//            ->notEmpty('notes4');
//
//        $validator
//            ->requirePresence('window_door_suite_manufacturer', 'create')
//            ->notEmpty('window_door_suite_manufacturer');
//
//        $validator
//            ->boolean('quoted')
//            ->requirePresence('quoted', 'create')
//            ->notEmpty('quoted');
//
//        $validator
//            ->boolean('printed')
//            ->requirePresence('printed', 'create')
//            ->notEmpty('printed');
//
//        $validator
//            ->boolean('send_file_to_manufacturer')
//            ->requirePresence('send_file_to_manufacturer', 'create')
//            ->notEmpty('send_file_to_manufacturer');
//
//        $validator
//            ->allowEmpty('mf_role');

        $validator
            ->integer('invoice_second_1_price')
            ->allowEmpty('invoice_second_1_price');

        $validator
            ->integer('invoice_second_2_price')
            ->allowEmpty('invoice_second_2_price');

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
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
