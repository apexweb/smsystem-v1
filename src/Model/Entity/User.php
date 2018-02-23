<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $role
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $email
 * @property float $discount
 *
 * @property \App\Model\Entity\Quote[] $quotes
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }


    protected function _getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    protected function _getPrintout() {
        if ($this->avatar) {

            return '<img class="img-responsive" style="width:100%;" src="data:image/png;base64,' . base64_encode(stream_get_contents($this->avatar)) . '" alt="Printout Header Image" >';
        }
        return '<span>Printout Header Image</span>';

    }
}
