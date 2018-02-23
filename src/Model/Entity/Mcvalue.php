<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mcvalue Entity
 *
 * @property int $id
 * @property string $secperf_dist
 * @property string $secperf_whsl
 * @property string $secperf_re
 * @property string $dgfibr_dist
 * @property string $dgfibr_whsl
 * @property string $dgfibr_re
 * @property string $std
 * @property string $spec1
 * @property string $spec2
 * @property string $spec3
 * @property string $spec4
 * @property string $hrly_sd
 * @property string $hrly_sw
 * @property string $hrly_dd
 * @property string $hrly_dw
 * @property string $hrly_fd
 * @property string $hrly_fw
 * @property string $hrly_pd
 * @property string $hrly_pw
 * @property string $cleanup_sd
 * @property string $cleanup_sw
 * @property string $cleanup_dd
 * @property string $cleanup_dw
 * @property string $cleanup_fd
 * @property string $cleanup_fw
 * @property string $cleanup_pd
 * @property string $cleanup_pw
 * @property string $markup_sd
 * @property string $markup_sw
 * @property string $markup_dd
 * @property string $markup_dw
 * @property string $markup_fd
 * @property string $markup_fw
 * @property string $markup_pd
 * @property string $markup_pw
 */
class Mcvalue extends Entity
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
