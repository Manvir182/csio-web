<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RiskSeverityScales Model
 *
 * @method \App\Model\Entity\RiskSeverityScale get($primaryKey, $options = [])
 * @method \App\Model\Entity\RiskSeverityScale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RiskSeverityScale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RiskSeverityScale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RiskSeverityScale saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RiskSeverityScale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RiskSeverityScale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RiskSeverityScale findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FfiecMaturityLevelsTable extends Table
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

        $this->setTable('ffiec_maturity_levels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('severity_scale')
            ->maxLength('severity_scale', 255)
            ->allowEmptyString('severity_scale');

       
        return $validator;
    }
}
