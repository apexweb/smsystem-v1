<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customitem Entity
 *
 * @property int $id
 * @property int $custom_qty
 * @property string $custom_description
 * @property string|resource $custom_tick
 * @property string $custom_price
 * @property string $custom_markup
 * @property int $quote_id
 *
 * @property \App\Model\Entity\Quote $quote
 */
class Customitem extends Entity
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
