<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accessory Entity
 *
 * @property int $id
 * @property string $accessory_item_number
 * @property int $accessory_each
 * @property string $accessory_name
 * @property string $accessory_price
 * @property int $quote_id
 *
 * @property \App\Model\Entity\Quote $quote
 */
class Accessory extends Entity
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
