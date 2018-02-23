<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Additionalpermeter Entity
 *
 * @property int $id
 * @property string $additional_item_number
 * @property string $additional_name
 * @property int $additional_per_meter
 * @property string $additional_price
 * @property int $quote_id
 *
 * @property \App\Model\Entity\Quote $quote
 */
class Additionalpermeter extends Entity
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
