<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Risks Model
 *
 * @method \App\Model\Entity\Risk get($primaryKey, $options = [])
 * @method \App\Model\Entity\Risk newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Risk[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Risk|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Risk saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Risk patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Risk[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Risk findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FfiecRisksTable extends Table
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

        $this->setTable('ffiec_risks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->hasMany('FfiecRiskFactors', [
            'foreignKey' => 'risk_id'
        ]);
		
		$this->hasMany('FfiecMasterRcMappings', [
            'foreignKey' => 'frisk_id'
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
/*
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');
		/*
        $validator
            ->scalar('description')
            ->allowEmptyString('description');
		*/
        return $validator;
    }
	
	public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
	
}
