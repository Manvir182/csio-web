<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegulatoryBody Entity
 *
 * @property int $id
 * @property string|null $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\GenControl[] $gen_controls
 * @property \App\Model\Entity\RbControl[] $rb_controls
 * @property \App\Model\Entity\Assessment[] $assessments
 */
class RegulatoryBody extends Entity
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
        'created' => true,
        'modified' => true,
        'gen_controls' => true,
        'rb_controls' => true,
        'assessments' => true,
        'activities' => true,
        'activity_id' => true
    ];
}
