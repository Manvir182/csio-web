<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssessmentControlRequirement Entity
 *
 * @property int $id
 * @property int|null $assessment_control_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $artifact
 * @property string|null $reference
 * @property string|null $compliance_status
 * @property float|null $compliance_score
 * @property int|null $assessed_by
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\AssessmentControl $assessment_control
 * @property \App\Model\Entity\AcrStatus[] $acr_statuses
 */
class AssessmentControlRequirement extends Entity
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
        'name' => true,
        'description' => true,
        'artifact' => true,
        'reference' => true,
        'compliance_status' => true,
        'compliance_score' => true,
        'assessed_by' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'assessment_control' => true,
        'acr_statuses' => true
    ];
}
