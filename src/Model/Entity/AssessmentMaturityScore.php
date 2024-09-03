<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssessmentMatirutyScore Entity
 *
 * @property int $id
 * @property int|null $assessment_control_id
 * @property string|null $maturity_attribute
 * @property string|null $maturity_option
 * @property float|null $score
 *
 * @property \App\Model\Entity\AssessmentControl $assessment_control
 */
class AssessmentMaturityScores extends Entity
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
        'assessment_control_id' => true,
        'maturity_attribute' => true,
        'maturity_option' => true,
        'score' => true,
        'assessment_control' => true
    ];
}
