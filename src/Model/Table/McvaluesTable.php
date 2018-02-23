<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mcvalues Model
 *
 * @method \App\Model\Entity\Mcvalue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mcvalue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mcvalue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mcvalue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mcvalue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mcvalue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mcvalue findOrCreate($search, callable $callback = null)
 */
class McvaluesTable extends Table
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

        $this->table('mcvalues');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
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

        $validator
            ->allowEmpty('secperf_dist');

        $validator
            ->allowEmpty('secperf_whsl');

        $validator
            ->allowEmpty('secperf_re');

        $validator
            ->allowEmpty('dgfibr_dist');

        $validator
            ->allowEmpty('dgfibr_whsl');

        $validator
            ->allowEmpty('dgfibr_re');

        $validator
            ->allowEmpty('std');

        $validator
            ->allowEmpty('spec1');

        $validator
            ->allowEmpty('spec2');

        $validator
            ->allowEmpty('spec3');

        $validator
            ->allowEmpty('spec4');

        $validator
            ->allowEmpty('hrly_sd');

        $validator
            ->allowEmpty('hrly_sw');

        $validator
            ->allowEmpty('hrly_dd');

        $validator
            ->allowEmpty('hrly_dw');

        $validator
            ->allowEmpty('hrly_fd');

        $validator
            ->allowEmpty('hrly_fw');

        $validator
            ->allowEmpty('hrly_pd');

        $validator
            ->allowEmpty('hrly_pw');

        $validator
            ->allowEmpty('cleanup_sd');

        $validator
            ->allowEmpty('cleanup_sw');

        $validator
            ->allowEmpty('cleanup_dd');

        $validator
            ->allowEmpty('cleanup_dw');

        $validator
            ->allowEmpty('cleanup_fd');

        $validator
            ->allowEmpty('cleanup_fw');

        $validator
            ->allowEmpty('cleanup_pd');

        $validator
            ->allowEmpty('cleanup_pw');

        $validator
            ->allowEmpty('markup_sd');

        $validator
            ->allowEmpty('markup_sw');

        $validator
            ->allowEmpty('markup_dd');

        $validator
            ->allowEmpty('markup_dw');

        $validator
            ->allowEmpty('markup_fd');

        $validator
            ->allowEmpty('markup_fw');

        $validator
            ->allowEmpty('markup_pd');

        $validator
            ->allowEmpty('markup_pw');

        return $validator;
    }
}
