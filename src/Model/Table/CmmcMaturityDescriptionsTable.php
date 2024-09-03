<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class CmmcMaturityDescriptionsTable extends Table
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

        $this->setTable('cmmc_maturity_descriptions');
        //$this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

		$this->belongsTo('CmmcMaturityAttributes', [
            'foreignKey' => 'ma_id'
        ]);
		$this->belongsTo('CmmcMaturityAttributeOptions', [
            'foreignKey' => 'mao_id'
        ]);
       
    }

   
   
}
