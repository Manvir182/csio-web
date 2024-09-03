<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class MaturityDescriptionsTable extends Table
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

        $this->setTable('maturity_descriptions');
        //$this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->belongsTo('MaturityAttributes', [
            'foreignKey' => 'ma_id'
        ]);
		$this->belongsTo('MaturityAttributeOptions', [
            'foreignKey' => 'mao_id'
        ]);
       
    }

   
   
}
