<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssessmentControls Model
 *
 * @property \App\Model\Table\AssessmentsTable|\Cake\ORM\Association\BelongsTo $Assessments
 * @property \App\Model\Table\AssessmentControlRequirementsTable|\Cake\ORM\Association\HasMany $AssessmentControlRequirements
 * @property \App\Model\Table\AssessmentMatirutyScoresTable|\Cake\ORM\Association\HasMany $AssessmentMatirutyScores
 * @property \App\Model\Table\RcMappingsTable|\Cake\ORM\Association\HasMany $RcMappings
 *
 * @method \App\Model\Entity\AssessmentControl get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssessmentControl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssessmentControl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentControl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentControl saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentControl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentControl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentControl findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssessmentControlsTable extends Table
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

        $this->setTable('assessment_controls');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id'
        ]);
		$this->belongsTo('AssessmentsRegulatoryBodies', [
            'foreignKey' => 'arb_id'
        ]);
		
        $this->hasMany('AssessmentControlRequirements', [
            'foreignKey' => 'assessment_control_id',
            'dependent' => true,
        ]);
        $this->hasMany('AssessmentMaturityScores', [
            'foreignKey' => 'assessment_control_id',
            'dependent' => true,
        ]);
        $this->hasMany('RcMappings', [
            'foreignKey' => 'assessment_control_id'
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
        $rules->add($rules->existsIn(['assessment_id'], 'Assessments'));

        return $rules;
    }
}
