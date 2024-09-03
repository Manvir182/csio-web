<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssessmentRisks Model
 *
 * @property \App\Model\Table\AssessmentsTable|\Cake\ORM\Association\BelongsTo $Assessments
 * @property \App\Model\Table\RcMappingsTable|\Cake\ORM\Association\HasMany $RcMappings
 *
 * @method \App\Model\Entity\AssessmentRisk get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssessmentRisk newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssessmentRisk[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentRisk|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentRisk saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentRisk patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentRisk[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentRisk findOrCreate($search, callable $callback = null, $options = [])
 */
class AssessmentRisksTable extends Table
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

        $this->setTable('assessment_risks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id'
        ]);
		$this->belongsTo('AssessmentsRegulatoryBodies', [
            'foreignKey' => 'arb_id'
        ]);
        $this->hasMany('RcMappings', [
            'foreignKey' => 'assessment_risk_id'
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
            ->scalar('risk')
            ->maxLength('risk', 255)
            ->allowEmptyString('risk');

        $validator
            ->scalar('risk_description')
            ->allowEmptyString('risk_description');

        $validator
            ->scalar('inherent_scale')
            ->maxLength('inherent_scale', 255)
            ->allowEmptyString('inherent_scale');

        $validator
            ->numeric('residual_score')
            ->allowEmptyString('residual_score');

        $validator
            ->scalar('residual_scale')
            ->allowEmptyString('residual_scale');

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
        $rules->add($rules->existsIn(['assessment_id'], 'Assessments'));

        return $rules;
    }
}
