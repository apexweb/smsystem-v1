<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stock Entity
 *
 * @property int $id
 * @property int $mf_id
 * @property string $status
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Mf $mf
 * @property \App\Model\Entity\Stockmeta[] $stockmetas
 */
class Stock extends Entity
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
        '*' => true,
        'id' => false
    ];


    protected function _getFullInfo() {
        return '(#' . $this->id . ') ' . $this->created->format('d/m/Y');
    }
}
