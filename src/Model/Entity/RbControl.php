<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RbControl Entity
 *
 * @property int $id
 * @property int|null $regulatory_body_id
 * @property string|null $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\RegulatoryBody $regulatory_body
 * @property \App\Model\Entity\RbControlRequirement[] $rb_control_requirements
 */
class RbControl extends Entity
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
        '*'=>true
    ];
}
