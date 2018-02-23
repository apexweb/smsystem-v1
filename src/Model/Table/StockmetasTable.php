<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stockmetas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Stocks
 * @property \Cake\ORM\Association\BelongsTo $Quotes
 *
 * @method \App\Model\Entity\Stockmeta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Stockmeta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Stockmeta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Stockmeta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Stockmeta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Stockmeta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Stockmeta findOrCreate($search, callable $callback = null)
 */
class StockmetasTable extends Table
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

        $this->table('stockmetas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Stocks', [
            'foreignKey' => 'stock_id',
            'joinType' => 'INNER'
        ]);

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
            ->requirePresence('metakey', 'create')
            ->notEmpty('metakey');

        $validator
            ->requirePresence('metavalue', 'create')
            ->notEmpty('metavalue');

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
        $rules->add($rules->existsIn(['stock_id'], 'Stocks'));
        $rules->add($rules->existsIn(['quote_id'], 'Quotes'));

        return $rules;
    }
}
