<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $product_item_number
 * @property int $product_qty
 * @property string $product_sec_dig_perf_fibr
 * @property string $product_316_ss_gal_pet
 * @property string $product_window_or_door
 * @property string $product_emergency_window
 * @property string $product_window_frame_type
 * @property string $product_configuration
 * @property string $product_location_in_building
 * @property int $product_width
 * @property int $product_height
 * @property string $product_number_of_locks
 * @property string $product_lock_type
 * @property string $product_lock_handle_height
 * @property int $quote_id
 *
 * @property \App\Model\Entity\Quote $quote
 */
class Product extends Entity
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
    
    protected function _getColour() {
        $product_colour = '';
        if ($this->_properties['product_colour']) {
            list($colourGroup, $product_colour) = explode('|', $this->_properties['product_colour']);
        }        
        return $product_colour;
    }


    /**
     * @return string
     */

}
