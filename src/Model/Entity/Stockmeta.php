<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stockmeta Entity
 *
 * @property int $id
 * @property string $metakey
 * @property string $metavalue
 * @property int $stock_id
 * @property int $quote_id
 *
 * @property \App\Model\Entity\Stock $stock
 * @property \App\Model\Entity\Quote $quote
 */
class Stockmeta extends Entity
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
}
