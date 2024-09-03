<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssessmentRisk Entity
 *
 * @property int $id
 * @property int|null $assessment_id
 * @property string|null $risk
 * @property string|null $risk_description
 * @property string|null $inherent_scale
 * @property float|null $residual_score
 * @property string|null $residual_scale
 *
 * @property \App\Model\Entity\Assessment $assessment
 * @property \App\Model\Entity\RcMapping[] $rc_mappings
 */
class AssessmentRisk extends Entity
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
        'assessment_id' => true,
        'risk_id'=>true,
        'risk' => true,
        'risk_description' => true,
        'inherent_scale' => true,
        'residual_score' => true,
        'residual_scale' => true,
        'inherent_variant'=>true,
        'assessment' => true,
        'rc_mappings' => true
    ];
}
