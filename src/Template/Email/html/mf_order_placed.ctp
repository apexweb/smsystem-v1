<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php use Cake\Routing\Router;?>
<div
    style="font-size: 14px; color: #4f4f4f; font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <p>Hello, A new order has received.</p>
    <p>Order No.: <strong><?= $quote->qId; ?></strong></p>
    <p>Order in Date: <strong><?php if ($quote->orderin_date) echo $quote->orderin_date; ?></strong></p>
    <p>Required Date: <strong><?php if ($quote->required_date) echo $quote->required_date; ?></strong></p>
    <p>Customer Name: <strong><?= $quote->customer_name; ?></strong></p>
	<p></p>
    <?php $url = Router::url(array("controller"=>"users","action"=>"login"),true);?>
	<p><strong><a href="<?php echo $url;?>">Login</a></strong></p>
</div>
