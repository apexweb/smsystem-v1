<?php
namespace App\Model\Entity;

use Cake\I18n\Time;
use Cake\ORM\Entity;

/**
 * Quote Entity
 *
 * @property int $id
 * @property int $original_id
 * @property string $order_date
 * @property string $required_date
 * @property string $orderin_date
 * @property string $notes
 * @property string $notes2
 * @property string $notes3
 * @property string $customer_name
 * @property string $mobile
 * @property string $phone
 * @property string $email
 * @property string $fax
 * @property string $street
 * @property string $suburb
 * @property string $postcode
 * @property string $standard
 * @property string $second_color_required
 * @property string $color1
 * @property string $color2
 * @property string $color3
 * @property string $color4
 * @property string $standard_color
 * @property string $color1_color
 * @property string $color2_color
 * @property string $color3_color
 * @property string $color4_color
 * @property string $installation_required
 * @property int $additional_installation_amount
 * @property int $status
 * @property string $count_additional
 * @property string $freight_cost
 * @property string $notes4
 * @property string $window_door_suite_manufacturer
 * @property string $total_sell_price
 * @property string $installation_total_cost
 * @property bool $quoted
 * @property bool $printed
 * @property bool $send_file_to_manufacturer
 * @property string $role
 * @property string $mfrole
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Quote extends Entity
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
        'id' => false,
    ];


    /* Order No */
    protected function _getQId()
    {
        //Order No.
        return $this->id + 1042;
    }

    public function getOldQidById($oldId) {
        return $oldId + 1042;
    }


    protected function _getWarrantyAddress()
    {
        return $this->street . ' ' . $this->suburb . ' ' . $this->postcode;
    }

    protected function _getInvoiceCost()
    {
        $totalCost = round($this->total_sell_price - $this->installation_total_cost - $this->getCustomItemsCharged() + $this->getCustomItemsCosts() - $this->profit + $this->getCustomItemsMarkups(), 2);
        return $totalCost;
    }


    protected function _getShortRole() {
        $role = '';
        if ($this->role == 'distributor' || $this->mfrole == 'distributor') {
            $role = 'Dist';
        } else if ($this->role == 'wholesaler' || $this->mfrole == 'wholesaler') {
            $role = 'Whsl';
        } else if ($this->role == 'retailer' || $this->mfrole == 'retailer') {
            $role = 'Re';
        }
        return $role;
    }

    protected function _setCustomerName($name)
    {
        return str_replace("'",'/',$name);
    }


    private function getCustomItemsCharged()
    {
        /* With Mark Up */
        $totalCharged = 0;

        if ($this['customitems']) {
            foreach ($this['customitems'] as $customitem) {
                $totalCharged += $customitem->custom_charged;
            }
        }

        return $totalCharged;
    }

    private function getCustomItemsMarkups() {
        /* Just Marked Up Amounts */
        $markedups = 0;
        if ($this['customitems']) {
            foreach ($this['customitems'] as $customitem) {
                $markedups += ($customitem->custom_qty * $customitem->custom_price * $customitem->custom_markup / 100);
            }
        }

        return $markedups;
    }

    private function getCustomItemsCosts()
    {
        /* Without Mark Up */
        $totalCost = 0;
        
        if ($this['customitems']) {
            foreach ($this['customitems'] as $customitem) {
                if ($customitem->custom_tick) {
                    $totalCost += ($customitem->custom_qty * $customitem->custom_price);
                }
            }
        }

        return $totalCost;
    }
}
