<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QuestionOption Entity
 *
 * @property int $id
 * @property int|null $question_id
 * @property string|null $name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Question $question
 */
class QuestionOption extends Entity
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
        'question_id' => true,
        'name' => true,
        'created' => true,
        'modified' => true,
        'question' => true
    ];
}
