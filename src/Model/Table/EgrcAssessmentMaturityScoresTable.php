<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssessmentMatirutyScores Model
 *
 * @property \App\Model\Table\AssessmentControlsTable|\Cake\ORM\Association\BelongsTo $AssessmentControls
 *
 * @method \App\Model\Entity\AssessmentMatirutyScore get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentMatirutyScore findOrCreate($search, callable $callback = null, $options = [])
 */
class EgrcAssessmentMaturityScoresTable extends Table
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

        $this->setTable('egrc_assessment_maturity_scores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('EgrcAssessmentPolicies', [
            'foreignKey' => 'egrc_assessment_policy_id'
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
            ->scalar('maturity_attribute')
            ->maxLength('maturity_attribute', 255)
            ->allowEmptyString('maturity_attribute');

        $validator
            ->scalar('maturity_option')
            ->maxLength('maturity_option', 255)
            ->allowEmptyString('maturity_option');

        $validator
            ->numeric('score')
            ->allowEmptyString('score');

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
        $rules->add($rules->existsIn(['egrc_assessment_policy_id'], 'EgrcAssessmentPolicies'));

        return $rules;
    }
}
