<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersParts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Parts
 *
 * @method \App\Model\Entity\UsersPart get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersPart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersPart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersPart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersPart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersPart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersPart findOrCreate($search, callable $callback = null)
 */
class UsersPartsTable extends Table
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

        $this->table('users_parts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Parts', [
            'foreignKey' => 'part_id',
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
            ->allowEmpty('supplier');

        $validator
            ->numeric('buy_price_include_GST')
            ->allowEmpty('buy_price_include_GST');

        $validator
            ->allowEmpty('unit');

        $validator
            ->numeric('size')
            ->allowEmpty('size');

        $validator
            ->numeric('mark_up')
            ->allowEmpty('mark_up');

        $validator
            ->numeric('marked_up')
            ->allowEmpty('marked_up');

        $validator
            ->numeric('price_per_unit')
            ->allowEmpty('price_per_unit');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['part_id'], 'Parts'));

        return $rules;
    }
}
