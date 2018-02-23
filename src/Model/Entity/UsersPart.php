<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersPart Entity
 *
 * @property int $id
 * @property string $supplier
 * @property float $buy_price_include_GST
 * @property string $unit
 * @property float $size
 * @property float $mark_up
 * @property float $marked_up
 * @property float $price_per_unit
 * @property int $user_id
 * @property int $part_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Part $part
 */
class UsersPart extends Entity
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
    
    protected function _getUnit()
    {   
        if($this->_properties['unit']){
            return $this->_properties['unit'];
        }
        return $this->_properties['part']->unit;
    }
    
    protected function _getSize()
    {   
        if($this->_properties['size']){
            return $this->_properties['size'];
        }
        return $this->_properties['part']->size;
    }
}
