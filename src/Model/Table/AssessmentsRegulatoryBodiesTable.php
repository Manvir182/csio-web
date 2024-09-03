<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssessmentsRegulatoryBodies Model
 *
 * @property \App\Model\Table\AssessmentsTable|\Cake\ORM\Association\BelongsTo $Assessments
 * @property \App\Model\Table\RegulatoryBodiesTable|\Cake\ORM\Association\BelongsTo $RegulatoryBodies
 *
 * @method \App\Model\Entity\AssessmentsRegulatoryBody get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssessmentsRegulatoryBody findOrCreate($search, callable $callback = null, $options = [])
 */
class AssessmentsRegulatoryBodiesTable extends Table
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

        $this->setTable('assessments_regulatory_bodies');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Assessments', [
            'foreignKey' => 'assessment_id'
        ]);
		
        $this->belongsTo('RegulatoryBodies', [
            'foreignKey' => 'regulatory_body_id'
        ]);
		
		$this->hasMany('AssessmentControls', [
            'foreignKey' => 'arb_id',
            'dependent' => true,
        ]);
        $this->hasMany('AssessmentRisks', [
            'foreignKey' => 'arb_id',
            'dependent' => true,
        ]);
        $this->hasMany('AssessmentSeverityScales', [
            'foreignKey' => 'arb_id',
            'dependent' => true,
        ]);
		
		$this->hasMany('RcMappings', [
            'foreignKey' => 'arb_id',
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
        //$rules->add($rules->existsIn(['regulatory_body_id'], 'RegulatoryBodies'));

        return $rules;
    }
}
