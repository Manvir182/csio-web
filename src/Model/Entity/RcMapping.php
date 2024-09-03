<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RcMapping Entity
 *
 * @property int $id
 * @property int|null $assessment_risk_id
 * @property int|null $assessment_control_id
 * @property string|null $mapping
 *
 * @property \App\Model\Entity\AssessmentRisk $assessment_risk
 * @property \App\Model\Entity\AssessmentControl $assessment_control
 */
class RcMapping extends Entity
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
        'assessment_risk_id' => true,
        'assessment_control_id' => true,
        'mapping' => true,
        'status'=>true,
        'arb_id'=>true,
        'assessment_id'=>true,
        'assessment_risk' => true,
        'assessment_control' => true
    ];
}
