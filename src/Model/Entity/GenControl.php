<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GenControl Entity
 *
 * @property int $id
 * @property int|null $regulatory_body_id
 * @property string|null $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\RegulatoryBody $regulatory_body
 * @property \App\Model\Entity\GenControlRequirement[] $gen_control_requirements
 */
class GenControl extends Entity
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
        'regulatory_body_id' => true,
        'name' => true,
        'description' => true,
        'guidance' => true,
        'created' => true,
        'modified' => true,
        'regulatory_body' => true,
        'gen_control_requirements' => true
    ];
}
