<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Midrail Entity
 *
 * @property int $id
 * @property string $midrail_item_number
 * @property int $midrail_qty
 * @property string $midrail_sec_dig_perf_fibr
 * @property string $midrail_316_ssgal_pet
 * @property string $midrail_window_or_door
 * @property int $midrail_height
 * @property int $midrail_width
 * @property string $midrail_window_frame_type
 * @property string $midrails_configuration
 * @property int $quote_id
 *
 * @property \App\Model\Entity\Quote $quote
 */
class Midrail extends Entity
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
