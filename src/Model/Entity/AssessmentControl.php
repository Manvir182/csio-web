<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssessmentControl Entity
 *
 * @property int $id
 * @property int|null $assessment_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $evidence_file
 * @property string|null $compliance_status
 * @property float|null $compliance_score
 * @property float|null $maturity_rating
 * @property float|null $sub_total
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Assessment $assessment
 * @property \App\Model\Entity\AssessmentControlRequirement[] $assessment_control_requirements
 * @property \App\Model\Entity\AssessmentMatirutyScore[] $assessment_matiruty_scores
 * @property \App\Model\Entity\RcMapping[] $rc_mappings
 */
class AssessmentControl extends Entity
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
        'control_id'=>true,
        'name' => true,
        'description' => true,
        'evidence_file' => true,
        'compliance_status' => true,
        'compliance_score' => true,
        'maturity_rating' => true,
        'sub_total' => true,
        'created' => true,
        'status'=>true,
        'mapping_status'=>true,
        'modified' => true,
        'assessment' => true,
        'assessment_control_requirements' => true,
        'assessment_maturity_scores' => true,
        'rc_mappings' => true
    ];
}
