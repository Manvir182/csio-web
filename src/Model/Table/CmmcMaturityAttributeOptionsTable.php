<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaturityAttributeOptions Model
 *
 * @method \App\Model\Entity\MaturityAttributeOption get($primaryKey, $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaturityAttributeOption findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CmmcMaturityAttributeOptionsTable extends Table
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

        $this->setTable('cmmc_maturity_attribute_options');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->hasMany('CmmcMaturityDescriptions', [
            'foreignKey' => 'mao_id'
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
            ->numeric('score')
            ->allowEmptyString('score');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
