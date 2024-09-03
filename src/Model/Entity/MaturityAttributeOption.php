<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MaturityAttributeOption Entity
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $score
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class MaturityAttributeOption extends Entity
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
        'name' => true,
        'score' => true,
        'description' => true,
        'created' => true,
        'modified' => true
    ];
}
