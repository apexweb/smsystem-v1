<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customitems Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\Customitem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customitem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customitem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customitem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customitem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customitem findOrCreate($search, callable $callback = null)
 */
class CustomitemsTable extends Table
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

        $this->table('customitems');
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
//            ->integer('custom_qty')
//            ->requirePresence('custom_qty', 'create')
//            ->notEmpty('custom_qty');
//
//        $validator
//            ->requirePresence('custom_description', 'create')
//            ->notEmpty('custom_description');
//
//        $validator
//            ->allowEmpty('custom_tick');
//
//        $validator
//            ->requirePresence('custom_price', 'create')
//            ->notEmpty('custom_price');
//
//        $validator
//            ->allowEmpty('custom_markup');

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
