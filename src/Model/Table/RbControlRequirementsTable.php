<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RbControlRequirements Model
 *
 * @property \App\Model\Table\RbControlsTable|\Cake\ORM\Association\BelongsTo $RbControls
 *
 * @method \App\Model\Entity\RbControlRequirement get($primaryKey, $options = [])
 * @method \App\Model\Entity\RbControlRequirement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RbControlRequirement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RbControlRequirement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RbControlRequirement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RbControlRequirement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RbControlRequirement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RbControlRequirement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RbControlRequirementsTable extends Table
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

        $this->setTable('rb_control_requirements');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RbControls', [
            'foreignKey' => 'rb_control_id'
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
            ->scalar('req_number')
            ->maxLength('req_number', 255)
            ->allowEmptyString('req_number');
        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->existsIn(['rb_control_id'], 'RbControls'));

        return $rules;
    }
}
