<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Quotes
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('username');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        //$this->addBehavior('Tree');

        $this->hasMany('Quotes', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('Mcvalues', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);


        $this->belongsToMany('Parts', [
            'joinTable' => 'users_parts',
        ]);

        $this->hasMany('users_parts', [
            'foreignKey' => 'user_id',
            'dependent' => true,
        ]);

        $this->hasMany('Prices', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('Dropdowns', [
            'foreignKey' => 'user_id'
        ]);


        $this->hasOne('Installations', [
            'foreignKey' => 'user_id'
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
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->add('password', [
                'compare' => [
                    'rule' => ['compareWith', 'confirm_password']
                ]
            ])
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'supplier', 'manufacturer', 'distributor', 'wholesaler', 'retailer', 'installer', 'candidate']],
                'message' => 'Please enter a valid role'
            ]);
    }


    public function validationPassword(Validator $validator)
    {
        $validator
            ->add('new_password', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password have to be at least 6 characters!',
                ]
            ])
            ->add('new_password', [
                'match' => [
                    'rule' => ['compareWith', 'confirm_password'],
                    'message' => 'The passwords do not match!',
                ]
            ])
            ->notEmpty('new_password');
        $validator
            ->add('confirm_password', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => 'The password have to be at least 6 characters!',
                ]
            ])
            ->add('confirm_password', [
                'match' => [
                    'rule' => ['compareWith', 'new_password'],
                    'message' => 'The passwords does not match!',
                ]
            ])
            ->notEmpty('confirm_password');

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
        $rules->add($rules->isUnique(['username']));
        //$rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
