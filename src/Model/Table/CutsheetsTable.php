<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cutsheets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\Cutsheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cutsheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cutsheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cutsheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cutsheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cutsheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cutsheet findOrCreate($search, callable $callback = null)
 */
class CutsheetsTable extends Table
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

        $this->table('cutsheets');
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
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('section');

        $validator
            ->allowEmpty('colour');

        $validator
            ->integer('cut_to_size')
            ->allowEmpty('cut_to_size');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->allowEmpty('notes');

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
