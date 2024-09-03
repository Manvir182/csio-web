<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RbControls Model
 *
 * @property \App\Model\Table\RegulatoryBodiesTable|\Cake\ORM\Association\BelongsTo $RegulatoryBodies
 * @property \App\Model\Table\RbControlRequirementsTable|\Cake\ORM\Association\HasMany $RbControlRequirements
 *
 * @method \App\Model\Entity\RbControl get($primaryKey, $options = [])
 * @method \App\Model\Entity\RbControl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RbControl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RbControl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RbControl saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RbControl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RbControl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RbControl findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RbControlsTable extends Table
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

        $this->setTable('rb_controls');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RegulatoryBodies', [
            'foreignKey' => 'regulatory_body_id'
        ]);
        $this->hasMany('RbControlRequirements', [
            'foreignKey' => 'rb_control_id',
            'dependent' => true,
        ]);
		$this->hasMany('RbRcMappings', [
            'foreignKey' => 'control_id',
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

		$validator
            ->scalar('control_number')
            ->maxLength('control_number', 255)
            ->allowEmptyString('control_number');
			
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
        $rules->add($rules->existsIn(['regulatory_body_id'], 'RegulatoryBodies'));
		//$rules->add($rules->isUnique(['name']));
        return $rules;
    }
	
    
}
