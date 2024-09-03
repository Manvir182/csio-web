<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assessment Entity
 *
 * @property int $id
 * @property int|null $owner_id
 * @property int|null $requester_id
 * @property string|null $case_number
 * @property string|null $atype
 * @property string|null $sub_type
 * @property string|null $name
 * @property string|null $status
 * @property string|null $evidence_file
 * @property string|null $file_name
 * @property string|null $file_description
 * @property string|null $signature
 * @property string|null $result_status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Owner $owner
 * @property \App\Model\Entity\Requester $requester
 * @property \App\Model\Entity\AssessmentControl[] $assessment_controls
 * @property \App\Model\Entity\AssessmentRisk[] $assessment_risks
 * @property \App\Model\Entity\AssessmentSeverityScale[] $assessment_severity_scales
 * @property \App\Model\Entity\AssessmentStatus[] $assessment_statuses
 * @property \App\Model\Entity\RegulatoryBody[] $regulatory_bodies
 */
class Assessment extends Entity
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
        'owner_id' => true,
        'requester_id' => true,
        'case_number' => true,
        'atype' => true,
        'sub_type' => true,
        'name' => true,
        'maturity_status'=>true,
        'mapping_status'=>true,
        'status' => true,
        'evidence_file' => true,
        'file_name' => true,
        'file_description' => true,
        'signature' => true,
        'result_status' => true,
        'created' => true,
        'modified' => true,
        'owner' => true,
        'requester' => true,
        'assessment_controls' => true,
        'assessment_risks' => true,
        'assessment_severity_scales' => true,
        'assessment_statuses' => true,
        'regulatory_bodies' => true,
        'assessments_regulatory_bodies' => true,
        'ffiec_assessment_risks'=>true,
        'ffiec_assessment_domains'=>true,
        'egrc_assessment_risks'=>true,
        'egrc_assessment_policies'=>true,
        'cmmc_assessment_domains'=>true
    ];
}
