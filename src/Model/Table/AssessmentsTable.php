<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assessments Model
 *
 * @property \App\Model\Table\OwnersTable|\Cake\ORM\Association\BelongsTo $Owners
 * @property \App\Model\Table\RequestersTable|\Cake\ORM\Association\BelongsTo $Requesters
 * @property \App\Model\Table\AssessmentControlsTable|\Cake\ORM\Association\HasMany $AssessmentControls
 * @property \App\Model\Table\AssessmentRisksTable|\Cake\ORM\Association\HasMany $AssessmentRisks
 * @property \App\Model\Table\AssessmentSeverityScalesTable|\Cake\ORM\Association\HasMany $AssessmentSeverityScales
 * @property \App\Model\Table\AssessmentStatusesTable|\Cake\ORM\Association\HasMany $AssessmentStatuses
 * @property \App\Model\Table\RegulatoryBodiesTable|\Cake\ORM\Association\BelongsToMany $RegulatoryBodies
 *
 * @method \App\Model\Entity\Assessment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Assessment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Assessment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Assessment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assessment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Assessment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Assessment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AssessmentsTable extends Table
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

        $this->setTable('assessments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'owner_id'
        ]);
		
        $this->belongsTo('Users', [
            'foreignKey' => 'requester_id'
        ]);
		
        $this->hasMany('AssessmentControls', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
        $this->hasMany('AssessmentRisks', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
        $this->hasMany('AssessmentSeverityScales', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
        $this->hasMany('AssessmentStatuses', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		$this->hasMany('AssessmentsRegulatoryBodies', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		$this->hasMany('RcMappings', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		$this->hasMany('FfiecRcMappings', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		$this->hasMany('FfiecAssessmentDomains', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		$this->hasMany('FfiecAssessmentRisks', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		
        $this->hasMany('EgrcAssessmentPolicies', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
        $this->hasMany('EgrcAssessmentRisks', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		$this->hasMany('EgrcRcMappings', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
		
		
		$this->hasMany('CmmcAssessmentDomains', [
            'foreignKey' => 'assessment_id',
            'dependent' => true,
        ]);
        
		
		/*
        $this->belongsToMany('RegulatoryBodies', [
            'foreignKey' => 'assessment_id',
            'targetForeignKey' => 'regulatory_body_id',
            'joinTable' => 'assessments_regulatory_bodies'
        ]);
		*/
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
            ->scalar('case_number')
            ->maxLength('case_number', 100)
            ->allowEmptyString('case_number');

        $validator
            ->scalar('atype')
            ->allowEmptyString('atype');

        $validator
            ->scalar('sub_type')
            ->allowEmptyString('sub_type');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');
		
        /*
        $validator
            ->scalar('evidence_file')
            ->maxLength('evidence_file', 400)
            ->allowEmptyFile('evidence_file');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 255)
            ->allowEmptyFile('file_name');

        $validator
            ->scalar('file_description')
            ->maxLength('file_description', 255)
            ->allowEmptyFile('file_description');
		*/

        $validator
            ->scalar('signature')
            ->maxLength('signature', 400)
            ->allowEmptyString('signature');

        $validator
            ->scalar('result_status')
            ->allowEmptyString('result_status');

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
        $rules->add($rules->existsIn(['owner_id'], 'Users'));
        $rules->add($rules->existsIn(['requester_id'], 'Users'));

        return $rules;
    }
}
