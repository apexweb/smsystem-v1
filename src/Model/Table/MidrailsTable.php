<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Midrails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\Midrail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Midrail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Midrail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Midrail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Midrail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Midrail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Midrail findOrCreate($search, callable $callback = null)
 */
class MidrailsTable extends Table
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

        $this->table('midrails');
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
//            ->allowEmpty('midrail_item_number');
//
//        $validator
//            ->integer('midrail_qty')
//            ->allowEmpty('midrail_qty');
//
//        $validator
//            ->allowEmpty('midrail_sec_dig_perf_fibr');
//
//        $validator
//            ->allowEmpty('midrail_316_ssgal_pet');
//
//        $validator
//            ->allowEmpty('midrail_window_or_door');
//
//        $validator
//            ->integer('midrail_height')
//            ->allowEmpty('midrail_height');
//
//        $validator
//            ->integer('midrail_width')
//            ->allowEmpty('midrail_width');
//
//        $validator
//            ->requirePresence('midrail_window_frame_type', 'create')
//            ->notEmpty('midrail_window_frame_type');
//
//        $validator
//            ->requirePresence('midrails_configuration', 'create')
//            ->notEmpty('midrails_configuration');

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
