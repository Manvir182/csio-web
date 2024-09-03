<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GenControlRequirement Entity
 *
 * @property int $id
 * @property int|null $gen_control_id
 * @property string|null $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\GenControl $gen_control
 */
class GenControlRequirement extends Entity
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
        'gen_control_id' => true,
        'name' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'gen_control' => true
    ];
}
