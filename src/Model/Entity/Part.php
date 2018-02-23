<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity
 *
 * @property int $id
 * @property string $title
 * @property string $supplier
 * @property float $buy_price_include_GST
 * @property string $unit
 * @property int $size
 * @property float $marked_up
 * @property int $mark_up
 * @property float $price_per_unit
 * @property string|resource $show_in_additional_section_dropdown
 * @property string|resource $show_in_additional_section_by_length_dropdown
 * @property string|resource $show_in_accessories_dropdown
 * @property int $master_calculator_value
 * @property int $display_order
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Part extends Entity
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


    public function __toString()
    {
        return $this->title;
    }

}
