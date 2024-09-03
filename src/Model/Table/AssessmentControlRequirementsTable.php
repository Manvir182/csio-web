<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssessmentControlRequirements Model
 *
 * @property \App\Model\Table\AssessmentControlsTable|\Cake\ORM\Association\BelongsTo $AssessmentControls
 * @property \App\Model\Table\AcrStatusesTable|\Cake\ORM\Association\HasMany $AcrStatuses
 *
 * @method \App\Model\Entity\AssessmentControlRequirement get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentControlRequirement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssessmentControlRequirementsTable extends Table
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

        $this->setTable('assessment_control_requirements');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AssessmentControls', [
            'foreignKey' => 'assessment_control_id'
        ]);
        $this->hasMany('AcrStatuses', [
            'foreignKey' => 'assessment_control_requirement_id'
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
   */
   
        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('artifact')
            ->allowEmptyString('artifact');

        $validator
            ->scalar('reference')
            ->allowEmptyString('reference');

        $validator
            ->scalar('compliance_status')
            ->allowEmptyString('compliance_status');

        $validator
            ->numeric('compliance_score')
            ->allowEmptyString('compliance_score');

        $validator
            ->integer('assessed_by')
            ->allowEmptyString('assessed_by');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['assessment_control_id'], 'AssessmentControls'));

        return $rules;
    }
}
