<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CompaniesTable|\Cake\ORM\Association\BelongsTo $Companies
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\AcrStatusesTable|\Cake\ORM\Association\HasMany $AcrStatuses
 * @property \App\Model\Table\AssessmentStatusesTable|\Cake\ORM\Association\HasMany $AssessmentStatuses
 * @property \App\Model\Table\LoginHistoryTable|\Cake\ORM\Association\HasMany $LoginHistory
 * @property \App\Model\Table\QuestionnairesTable|\Cake\ORM\Association\HasMany $Questionnaires
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('AcrStatuses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('AssessmentStatuses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('LoginHistory', [
            'foreignKey' => 'user_id'
        ]);

		$this->hasMany('Policies', [
            'foreignKey' => 'user_id',
            'finder'=>'Policies'
        ]);
		$this->hasMany('Standards', [
            'foreignKey' => 'user_id',
            'finder'=>'Standards'
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
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->allowEmptyString('username');

        $validator->add('password', 'custom', [
		    'rule' => function ($value, $context) {
		    	$status = preg_match("/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,100})$/", $value);

				if($status==1){
					return true;
				} else {
					return false;
				}

		    },
		    'message' => 'Invalid Password. Password must contain 1 Capital, 1 Special Character and 1 Number with the length of total 8 characters'
		])->notEmpty('password',"Login Password is required.");

        $validator
            ->scalar('company_code')
            ->maxLength('company_code', 100)
            ->allowEmptyString('company_code');

        $validator
            ->scalar('company_name')
            ->maxLength('company_name', 100)
            ->allowEmptyString('company_name');

        $validator
            ->scalar('position_title')
            ->maxLength('position_title', 100)
            ->allowEmptyString('position_title');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 200)
            ->allowEmptyString('phone');

        $validator
            ->scalar('contcode')
            ->maxLength('contcode', 10);

        $validator
            ->scalar('extension')
            ->maxLength('extension', 100)
            ->allowEmptyString('extension');

        $validator
            ->scalar('company_size')
            ->maxLength('company_size', 100)
            ->allowEmptyString('company_size');

        $validator
            ->scalar('industry')
            ->maxLength('industry', 100)
            ->allowEmptyString('industry');

        $validator
            ->scalar('department_size')
            ->maxLength('department_size', 100)
            ->allowEmptyString('department_size');

        $validator
            ->scalar('subscribed')
            ->allowEmptyString('subscribed');

        $validator
            ->scalar('role')
            ->allowEmptyString('role');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->allowEmptyString('photo');

        $validator
            ->scalar('registration_status')
            ->allowEmptyString('registration_status');

        $validator
            ->dateTime('reg_status_date')
            ->allowEmptyDateTime('reg_status_date');

        $validator
            ->scalar('reg_status_remarks')
            ->allowEmptyString('reg_status_remarks');

        $validator
            ->scalar('assessments_status')
            ->allowEmptyString('assessments_status');

        $validator
            ->scalar('source')
            ->allowEmptyString('source');

        $validator
            ->scalar('password_reset_token')
            ->allowEmptyString('password_reset_token');

        $validator
            ->dateTime('token_expiry_date')
            ->allowEmptyDateTime('token_expiry_date');

        return $validator;
    }

	public function validationUpdate(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmptyString('last_name');



        $validator->add('password', 'custom', [
		    'rule' => function ($value, $context) {
		    	$status = preg_match("/^((?=.*\d)(?=.*[A-Z])(?=.*\W).{8,100})$/", $value);

				if($status==1){
					return true;
				} else {
					return false;
				}

		    },
		    'message' => 'Invalid Password. Password must contain 1 Capital, 1 Special Character and 1 Number with the length of total 8 characters'
		])->allowEmptyString('password');


        $validator
            ->email('email')
            ->notEmpty('email',"Email is Required");


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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }


	//finder to fetch only standards from table
	public function findStandards(\Cake\ORM\Query $query, array $options){
	    $query->where(['Standards.type' => 'Standard']);
		return $query;
	}
	//finder to fetch only policies from table
	public function findPolicies(\Cake\ORM\Query $query, array $options){
	    $query->where(['Policies.type' => 'Policy']);
		return $query;
	}


	public function findEmp(\Cake\ORM\Query $query, array $options){
	    $query->where(['Users.role' => 'Employee',"Users.registration_status != 'Deleted'"]);
		return $query;
	}

	public function findSuspended(\Cake\ORM\Query $query, array $options){
	    $query->where(["Users.registration_status"=>'Approved','Users.role'=>'Company']);
		return $query;
		//this finder method was used to check if the account is suspended or not.
		//but later the condition is changed and method name kept unchanged.
	}

	public function findSuper(\Cake\ORM\Query $query, array $options){
	    $query->where(["Users.role"=>'Super Admin']);
		return $query;
	}

	public function findApprover(\Cake\ORM\Query $query, array $options){
	    $query->where(["Users.role"=>'Approver']);
		return $query;
	}

    public function findAnalysts(\Cake\ORM\Query $query, array $options){
	    $query->where(["Users.registration_status"=>'Approved','Users.role'=>'Analysts']);
		return $query;
		//this finder method was used to check if the account is suspended or not.
		//but later the condition is changed and method name kept unchanged.
	}
}