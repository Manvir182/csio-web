<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class CmmcDomainsTable extends Table
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

        $this->setTable('cmmc_domains');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('CmmcCapabilities', [
            'foreignKey' => 'cmmc_domain_id',
            'dependent' => true,
        ]);
		$this->hasMany('CmmcPractices', [
           'foreignKey' => 'cmmc_domain_id',
           'sort'=>[
           		'CmmcPractices.cmmc_level_id'=>'asc',
           		'CmmcPractices.cmmc_capability_id'=>'asc'
           ],
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
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

		$validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->allowEmptyString('code');
			
       

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
        //$rules->add($rules->existsIn(['regulatory_body_id'], 'RegulatoryBodies'));
		//$rules->add($rules->isUnique(['name']));
        return $rules;
    }
	
    
}
