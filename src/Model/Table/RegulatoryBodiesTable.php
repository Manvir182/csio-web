<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegulatoryBodies Model
 *
 * @property \App\Model\Table\GenControlsTable|\Cake\ORM\Association\HasMany $GenControls
 * @property \App\Model\Table\RbControlsTable|\Cake\ORM\Association\HasMany $RbControls
 * @property \App\Model\Table\AssessmentsTable|\Cake\ORM\Association\BelongsToMany $Assessments
 *
 * @method \App\Model\Entity\RegulatoryBody get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegulatoryBody newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RegulatoryBody[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegulatoryBody|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegulatoryBody saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegulatoryBody patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegulatoryBody[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegulatoryBody findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegulatoryBodiesTable extends Table
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

        $this->setTable('regulatory_bodies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('GenControls', [
            'foreignKey' => 'regulatory_body_id',
            'dependent' => true,
        ]);
        $this->hasMany('RbControls', [
            'foreignKey' => 'regulatory_body_id',
            'dependent' => true,
        ]);
		$this->hasMany('AssessmentsRegulatoryBodies', [
            'foreignKey' => 'regulatory_body_id',
            'dependent' => true,
        ]);
		$this->hasMany('RbRcMappings', [
            'foreignKey' => 'rb_id',
            'dependent' => true,
        ]);
		
		$this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
        ]);
		
        // $this->belongsToMany('Assessments', [
            // 'foreignKey' => 'regulatory_body_id',
            // 'targetForeignKey' => 'assessment_id',
            // 'joinTable' => 'assessments_regulatory_bodies'
        // ]);
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

        return $validator;
    }
}
