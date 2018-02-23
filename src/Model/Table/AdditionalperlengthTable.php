<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Additionalperlength Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\Additionalperlength get($primaryKey, $options = [])
 * @method \App\Model\Entity\Additionalperlength newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Additionalperlength[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Additionalperlength|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Additionalperlength patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Additionalperlength[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Additionalperlength findOrCreate($search, callable $callback = null)
 */
class AdditionalperlengthTable extends Table
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

        $this->table('additionalperlength');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Quotes', [
            'foreignKey' => 'quote_id'
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
//            ->allowEmpty('additional_item_number');
//
//        $validator
//            ->allowEmpty('additional_name');
//
//        $validator
//           ->integer('additional_per_length')
//           ->allowEmpty('additional_per_length');
//
//        $validator
//            ->requirePresence('additional_price', 'create')
//            ->notEmpty('additional_price');

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
