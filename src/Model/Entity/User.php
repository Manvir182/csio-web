<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $department_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string|null $password
 * @property string|null $company_code
 * @property string|null $company_name
 * @property string|null $position_title
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $contcode
 * @property string|null $extension
 * @property string|null $company_size
 * @property string|null $industry
 * @property string|null $department_size
 * @property string|null $subscribed
 * @property string|null $role
 * @property string|null $photo
 * @property string|null $registration_status
 * @property \Cake\I18n\FrozenTime|null $reg_status_date
 * @property string|null $reg_status_remarks
 * @property string|null $assessments_status
 * @property string|null $source
 * @property string|null $password_reset_token
 * @property \Cake\I18n\FrozenTime|null $token_expiry_date
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\AcrStatus[] $acr_statuses
 * @property \App\Model\Entity\AssessmentStatus[] $assessment_statuses
 * @property \App\Model\Entity\LoginHistory[] $login_history
 * @property \App\Model\Entity\Questionnaire[] $questionnaires
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'company_id' => true,
        'department_id' => true,
        'first_name' => true,
        'last_name' => true,
        'username' => true,
        'password' => true,
        'company_code' => true,
        'company_name' => true,
        'position_title' => true,
        'email' => true,
        'phone' => true,
        'contcode' => true,
        'extension' => true,
        'company_size' => true,
        'industry' => true,
        'department_size' => true,
        'subscribed' => true,
        'role' => true,
        'photo' => true,
        'registration_status' => true,
        'reg_status_date' => true,
        'reg_status_remarks' => true,
        'assessments_status' => true,
        'source' => true,
        'password_reset_token' => true,
        'token_expiry_date' => true,
        'created' => true,
        'modified' => true,
        'company' => true,
        'department' => true,
        'acr_statuses' => true,
        'assessment_statuses' => true,
        'login_history' => true,
        'questionnaires' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

	protected function _setPassword($value){
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
    }


}
