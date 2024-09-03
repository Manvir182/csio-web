<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AcrStatus Entity
 *
 * @property int $id
 * @property int|null $assessment_control_requirement_id
 * @property int|null $user_id
 * @property string|null $status
 * @property string|null $status_log
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\AssessmentControlRequirement $assessment_control_requirement
 * @property \App\Model\Entity\User $user
 */
class AcrStatus extends Entity
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
        'assessment_control_requirement_id' => true,
        'user_id' => true,
        'status' => true,
        'status_log' => true,
        'created' => true,
        'assessment_control_requirement' => true,
        'user' => true
    ];
}
