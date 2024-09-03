<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RcMappings Model
 *
 * @property \App\Model\Table\AssessmentRisksTable|\Cake\ORM\Association\BelongsTo $AssessmentRisks
 * @property \App\Model\Table\AssessmentControlsTable|\Cake\ORM\Association\BelongsTo $AssessmentControls
 *
 * @method \App\Model\Entity\RcMapping get($primaryKey, $options = [])
 * @method \App\Model\Entity\RcMapping newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RcMapping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RcMapping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RcMapping saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RcMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RcMapping[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RcMapping findOrCreate($search, callable $callback = null, $options = [])
 */
class EgrcRcMappingsTable extends Table
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

        $this->setTable('egrc_arc_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('EgrcAssessmentRisks', [
            'foreignKey' => 'egrc_assessment_risk_id'
        ]);
        $this->belongsTo('EgrcAssessmentPolicies', [
            'foreignKey' => 'egrc_assessment_policy_id'
        ]);
		$this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id'
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
            ->scalar('mapping')
            ->allowEmptyString('mapping');

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
        //$rules->add($rules->existsIn(['assessment_risk_id'], 'AssessmentRisks'));
        //$rules->add($rules->existsIn(['assessment_control_id'], 'AssessmentControls'));

        return $rules;
    }
}
