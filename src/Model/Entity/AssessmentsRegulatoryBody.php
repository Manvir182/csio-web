<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AssessmentsRegulatoryBody Entity
 *
 * @property int $id
 * @property int|null $assessment_id
 * @property int|null $regulatory_body_id
 *
 * @property \App\Model\Entity\Assessment $assessment
 * @property \App\Model\Entity\RegulatoryBody $regulatory_body
 */
class AssessmentsRegulatoryBody extends Entity
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
        'regulatory_body_id' => true,
        'assessment' => true,
        'regulatory_body' => true,
        'assessment_controls'=>true,
        'assessment_severity_scales'=>true,
        'assessment_risks'=>true
    ];
}
