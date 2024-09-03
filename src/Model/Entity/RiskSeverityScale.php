<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RiskSeverityScale Entity
 *
 * @property int $id
 * @property string|null $severity_scale
 * @property string|null $financial_loss
 * @property string|null $customer
 * @property string|null $regulatory
 * @property string|null $business_disruption
 * @property string|null $headline_risk
 * @property float|null $score
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class RiskSeverityScale extends Entity
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
        'severity_scale' => true,
        'financial_loss' => true,
        'customer' => true,
        'regulatory' => true,
        'business_disruption' => true,
        'headline_risk' => true,
        'score' => true,
        'created' => true,
        'modified' => true
    ];
}
