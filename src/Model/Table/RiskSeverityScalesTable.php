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
class RiskSeverityScalesTable extends Table
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

        $this->setTable('risk_severity_scales');
        $this->setDisplayField('severity_scale');
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

        $validator
            ->scalar('financial_loss')
            ->maxLength('financial_loss', 255)
            ->allowEmptyString('financial_loss');

        $validator
            ->scalar('customer')
            ->maxLength('customer', 255)
            ->allowEmptyString('customer');

        $validator
            ->scalar('regulatory')
            ->maxLength('regulatory', 255)
            ->allowEmptyString('regulatory');

        $validator
            ->scalar('business_disruption')
            ->maxLength('business_disruption', 255)
            ->allowEmptyString('business_disruption');

        $validator
            ->scalar('headline_risk')
            ->maxLength('headline_risk', 255)
            ->allowEmptyString('headline_risk');

        $validator
            ->numeric('score')
            ->allowEmptyString('score');

        return $validator;
    }
}
