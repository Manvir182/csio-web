<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GenControls Model
 *
 * @property \App\Model\Table\RegulatoryBodiesTable|\Cake\ORM\Association\BelongsTo $RegulatoryBodies
 * @property \App\Model\Table\GenControlRequirementsTable|\Cake\ORM\Association\HasMany $GenControlRequirements
 *
 * @method \App\Model\Entity\GenControl get($primaryKey, $options = [])
 * @method \App\Model\Entity\GenControl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\GenControl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\GenControl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GenControl saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\GenControl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\GenControl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\GenControl findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FfiecAssessmentDomainRequirementsTable extends Table
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

        $this->setTable('ffiec_assessment_domain_requirements');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->belongsTo('FfiecAssessmentDomainAFactors', [
            'foreignKey' => 'afactor_id'
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

       
        $validator
                   ->scalar('description')
                   ->allowEmptyString('description');
       */
       
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
