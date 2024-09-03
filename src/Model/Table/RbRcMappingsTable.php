<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Regulatory Bodies based Risk Control Mappings Model
 */
class RbRcMappingsTable extends Table
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

        $this->setTable('rb_rc_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Risks', [
            'foreignKey' => 'risk_id'
        ]);
		$this->belongsTo('RbControls', [
            'foreignKey' => 'control_id'
        ]);
		$this->belongsTo('RegulatoryBodies', [
            'foreignKey' => 'rb_id'
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
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('evidence_file')
            ->allowEmptyFile('evidence_file');

        $validator
            ->scalar('compliance_status')
            ->allowEmptyString('compliance_status');

        $validator
            ->numeric('compliance_score')
            ->allowEmptyString('compliance_score');

        $validator
            ->numeric('maturity_rating')
            ->allowEmptyString('maturity_rating');

        $validator
            ->numeric('sub_total')
            ->allowEmptyString('sub_total');

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
        //$rules->add($rules->existsIn(['assessment_id'], 'Assessments'));

        return $rules;
    }
}
