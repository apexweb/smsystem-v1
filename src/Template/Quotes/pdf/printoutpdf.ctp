<?php
$role = $quote->role;
$mfrole = $quote->mfrole;

$flatCustomPrice = false;
$customQuotedAmount = 0;

if ($quote->override_final_price) {
    $flatCustomPrice = true;
    $customQuotedAmount = $quote->custom_quoted_amount;
}

?>

<style>
.terms_table table tr td {border:none !important;vertical-align: initial;}
</style>
<div class="card-box printout">

    <?php if ($quote->user->avatar): ?>
        <div class="text-center" style="margin-bottom: 5px;">
            <?= $quote->user->printout ?>
        </div>
    <?php endif; ?>



</div>

<div class="card-box printout">
    
    <div class="customer-info">
        <table class="table table-responsive noborder" border="0">
            <tr>
                <td colspan="4" align="right">
                    <strong>Date:</strong>
                        <span id="order-date">
                            <?= h($quote->created->format('d/m/Y')) ?>
                        </span>
                    
                </td>
            </tr>
            <tr>
                <td width="40%"> 
                        <strong style="font-size: 12px !important;">Customer Name:</strong>
                        <span id="customer-name">
                            <?= h($quote->customer_name) ?>
                        </span>
                </td>
                <td width="20%">
                        <strong>Mobile:</strong>
                        <span id="mobile">
                            <?= h($quote->mobile) ?>
                        </span>
                </td>
                <td width="20%">
                        <span><strong>Phone:</strong></span>
                        <span id="phone">
                            <?= h($quote->phone) ?>
                        </span>
                </td>
                <td align="right" width="20%">
                        <strong>Order No. &nbsp; &nbsp;
                            <?= h($quote->qId) ?>
                        </strong>
                </td>
            </tr>
            
            <tr>
                <td>
                   <strong>Email:</strong>
                        <span id="email">
                            <?= h($quote->email) ?>
                        </span>
                    
                </td>
            </tr>
            
            <tr>
                <td>
                    <strong>Address:</strong>
                    <span id="street">
                        <?= h($quote->street) ?>
                    </span>
                </td> 
                <td>
                   <strong>Suburb:</strong>
                    <span id="suburb">
                        <?= h($quote->suburb) ?>
                    </span> 
                </td> 
                <td>
                    <strong>State:</strong>
                    <span id="state">
                        <?= h($quote->state) ?>
                    </span>   
                </td> 
                <td>
                    <strong>Postcode:</strong>
                    <span id="postcode">
                        <?= h($quote->postcode) ?>
                    </span>
                </td> 
            </tr>            
        </table>      
    </div>


</div>

<div class="card-box printout">
    <table class="table table-responsive table-bordered quote-printout small-padding heading-bg">
        <tr classs="th-bg">
            <th class="text-center width-40">NO</th>
            <th class="text-center qty">Qty</th>
            <th class="text-center width-70">Product</th>
            <th class="text-center width-40">Mesh Option</th>
            <th class="text-center width-30">Fixture</th>
            <th class="text-center width-75">Colour</th>
            <th class="text-center width-100">Config</th>
            <th class="text-center width-150">Location</th>
            <th class="text-center width-50"">Hght mm</th>
            <th class="text-center width-50">Wdth mm</th>
            <th class="text-center width-50">Lock Type</th>
            <th class="text-center width-55">Amount Inc. GST</th>
        </tr>

        <?php foreach ($quote['products'] as $product): ?>
            <?php if ($product->product_qty > 0): ?>
                <tr>
                    <td class="text-center no-top-bottom"><?= h($product->product_item_number) ?></td>
                    <td class="text-center no-top-bottom"><?= h($product->product_qty) ?></td>
                    <td class="text-center no-top-bottom"><?= h($product->product_sec_dig_perf_fibr) ?></td>
                    <td class="text-center no-top-bottom"><?= h($product->product_316_ss_gal_pet) ?></td>
                    <?php if ($product->product_window_or_door == 'Window'): ?>
                        <td class="text-center no-top-bottom">Win</td>
                    <?php elseif ($product->product_window_or_door == 'Door'): ?>
                        <td class="text-center no-top-bottom"><?= h($product->product_window_or_door) ?></td>
                    <?php else: ?>
                        <td class="text-center no-top-bottom"></td>
                    <?php endif; ?>
                    <td class="text-center no-top-bottom"><?= h($product->colour) ?></td>   
                    <td class="text-center no-top-bottom"><?= h($product->product_configuration) ?></td>
                    <td class="text-center no-top-bottom"><?= h($product->product_location_in_building) ?></td>
                    <td class="text-center no-top-bottom"><?= h($product->product_height) ?></td>
                    <td class="text-center no-top-bottom"><?= h($product->product_width) ?></td>
                    <td class="text-center no-top-bottom">
                        <?php
                        if ($product->product_lock_type == 'Triple Lock') {
                            echo 'Triple';
                        } else {
                            echo $product->product_lock_type;
                        }
                        ?>
                    </td>
                    <td class="text-left no-top-bottom">
                        <?php if (!$flatCustomPrice): ?>
                            <span>$</span><?= h($product->product_cost) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php
        $midrail_total_cost = 0;
        foreach ($quote['midrails'] as $midrail) {
            $midrail_total_cost += $midrail->midrail_cost;
        }
        ?>
        <?php if ($midrail_total_cost > 0): ?>
            <tr>
                <td colspan="2"></td>
                <td colspan="9" class="text-center"><strong>Midrails</strong></td>
                <td><span>$</span><?= $midrail_total_cost; ?></td>
            </tr>
        <?php endif; ?>
        <tr>           
            <td colspan="2" class="text-center bg-light-gray">Qty</td>
            <td colspan="6" class="text-center bg-light-gray"><strong>Sections and Accessories Required</strong></td>
            <td colspan="3" class="no-bottom"></td>
            <td></td>
        </tr>
        <!--   Addtional Per Meters:     -->
        <?php foreach ($quote['additionalpermeters'] as $additionalpermeter): ?>
            <?php if ($additionalpermeter->additional_per_meter > 0): ?>
                <tr>
                    <td class="no-top-bottom"></td>
                    <td class="no-top-bottom"><?= h($additionalpermeter->additional_per_meter) ?></td>
                    <td colspan="6" class="text-center no-top-bottom"><?= h($additionalpermeter->additional_name) ?></td>
                    <td colspan="3" class="no-top-bottom"></td>
                    <td class="text-left">
                        <?php if (!$flatCustomPrice): ?>
                            <span>$</span><?= h($additionalpermeter->additional_charged); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <!--    Additional Per Lengths:    -->
        <?php foreach ($quote['additionalperlength'] as $additionalperlength): ?>

            <?php if ($additionalperlength->additional_per_length > 0): ?>
                <tr>
                    <td class="no-top-bottom"></td>
                    <td class="no-top-bottom"><?= h($additionalperlength->additional_per_length) ?></td>
                    <td colspan="6" class="text-center no-top-bottom"><?= h($additionalperlength->additional_name) ?></td>
                    <td colspan="3" class="no-top-bottom"></td>
                    <td class="text-left">
                        <?php if (!$flatCustomPrice): ?>
                            <span>$</span><?= h($additionalperlength->additional_charged); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <!--    Accessories:   -->
        <?php foreach ($quote['accessories'] as $accessory): ?>
            <?php if ($accessory->accessory_each > 0): ?>
                <tr>
                    <td class="no-top-bottom"></td>
                    <td class="no-top-bottom"><?= h($accessory->accessory_each) ?></td>
                    <td colspan="6" class="text-center no-top-bottom"><?= h($accessory->accessory_name) ?></td>
                    <td colspan="3" class="no-top-bottom"></td>
                    <td class="text-left">
                        <?php if (!$flatCustomPrice): ?>
                            <span>$</span><?= h($accessory->accessory_charged); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <!--    Custom Items:   -->
        <?php foreach ($quote['customitems'] as $customitem): ?>
            <?php if ($customitem->custom_qty > 0): ?>
                <tr>
                    <td class="no-top-bottom"></td>
                    <td class="no-top-bottom"><?= h($customitem->custom_qty) ?></td>
                    <td colspan="6" class="text-center no-top-bottom"><?= h($customitem->custom_description) ?></td>
                    <td colspan="3" class="no-top-bottom"></td>
                    <td class="text-left">
                        <?php if (!$flatCustomPrice): ?>
                            <span>$</span><?= h($customitem->custom_charged); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <tr>
            <td colspan="2" class="no-right no-bottom"></td>
            <td colspan="6" class="no-top-bottom"></td>
            <td colspan="3" style="font-size:8px !important;">Screen Total incl. GST</td>
            <td class="text-left">
                <?php if (!$flatCustomPrice): ?>
                    <span>$</span><?= h($quote->total_sell_price - $quote->installation_total_cost); ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php if (isset($quote->discount_amount) && $quote->discount_amount > 0 && (!$flatCustomPrice)): ?>
            <tr>
                <td colspan="2" class="no-top-bottom"></td>
                <td colspan="6" class="no-top-bottom"></td>
                <td colspan="3" style="font-size:8px !important;">Discount Applied <?php if($quote->discount) echo ' - '. $quote->discount .'%';?></td>
                <td class="text-left"><span>$</span><?= h($quote->discount_amount); ?></td>
            </tr>
        <?php endif; ?>

        <tr>
            <td colspan="2" class="no-top-bottom"></td>
            <td colspan="6" class="text-center no-top-bottom"><strong>Colour</strong></td>
            <td colspan="3">Installation</td>
            <td class="text-left">
                <?php if (!$flatCustomPrice): ?>
                    <span>$</span><?= h($quote->installation_total_cost); ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="no-top-bottom"></td>
            <td colspan="6" class="text-center quote-colors no-top-bottom">

                <?php if ($quote->standard) {
                    echo '<p>' . h($quote->standard_color) . '</p>';
                }
                ?>
                <?php if ($quote->color1) {
                    echo '<p>' . h($quote->color1_color) . '</p>';
                }
                ?>
                <?php if ($quote->color2) {
                    echo '<p>' . h($quote->color2_color) . '</p>';
                }
                ?><?php if ($quote->color3) {
                    echo '<p>' . h($quote->color3_color) . '</p>';
                }
                ?><?php if ($quote->color4) {
                    echo '<p>' . h($quote->color4_color) . '</p>';
                }
                ?>
            </td>
            <td colspan="3" style="vertical-align: middle;" class="bg-light-gray"><strong>Final Amount</strong></td>
            <td class="text-left bg-light-gray">
                <strong>
                    <?php
                    echo '$';
                    if ($flatCustomPrice) {
                        echo h(floor($customQuotedAmount));
                    } else {
                        echo h(floor($quote->total_sell_price));
                    }
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="2">TERMS:</td>
            <td colspan="6"></td>
            <td colspan="3">Deposit Amount</td>
            <td class="text-left">

                <?php
                echo '$';
                if ($authUser['deposit_percent'] > 0) {
                    if ($flatCustomPrice) {
                        echo floor($authUser['deposit_percent'] * $customQuotedAmount / 100);
                    } else {
                        echo floor($authUser['deposit_percent'] * $quote->total_sell_price / 100);
                    }
                } else {
                    echo '0';
                }
                ?>
            </td>
        </tr>
		<?php if(isset($_SESSION['Auth']['User']['terms'])){?>
			<tr>
				<td colspan="8" style="border:none !important;">
					<div class="terms_table">
						<?php echo $_SESSION['Auth']['User']['terms']; ?>
						
					</div>
				</td>
				<td colspan="4" style="border:none !important;">	
					<table summary="removetrtd" class="table table-responsive small-padding">
						<tr>
							<td class="no-border" colspan="2" >Bank</td>
							<td class="no-border" colspan="2"><?= h($authUser['bank_name']) ?></td>
						</tr>
						<tr>
							<td class="no-border" colspan="2">Account Name</td>
							<td class="no-border" colspan="2"><?= h($authUser['bank_account_name']) ?></td>
						</tr>
						<tr>
							<td class="no-border" colspan="2">BSB</td>
							<td class="no-border" colspan="2"><?= h($authUser['bsb']) ?></td>
						</tr>
						<tr>
							<td class="no-border" colspan="2">Acc No.</td>
							<td class="no-border" colspan="2"><?= h($authUser['bank_account_number']) ?></td>
						</tr>
						<tr>
							<td colspan="4" class="no-border"></td>
						</tr>
					</table>
				</td>
			</tr>
		<?php } else { ?>
			<tr>
				<td class="no-border" colspan="4">*Estimate is subject to check measure</td>
				<td class="no-border" colspan="3">*Installation includes any freight/delivery charges if applicable</td>
				<td class="no-border" align="right">Bank Details</td>
				<td class="no-border" colspan="3">Bank</td>
				<td class="no-border"><?= h($authUser['bank_name']) ?></td>
			</tr>
			<tr>
				<td colspan="4"  class="no-border">*This estimate is valid for 30 days*</td>
				<td colspan="4" class="no-border"><strong>Please use the Order No as your payment reference</strong></td>
				<td class="no-border" colspan="3">Account Name</td>
				<td class="no-border"> <?= h($authUser['bank_account_name']) ?></td>
			</tr>
			<tr>
				<td colspan="8" class="no-border"></td>
				<td class="no-border" colspan="3">BSB</td>
				<td class="no-border"><?= h($authUser['bsb']) ?></td>
			</tr>
			<tr>
				<td class="no-border" colspan="8"></td>
				<td class="no-border" colspan="3">Acc No.</td>
				<td class="no-border"><?= h($authUser['bank_account_number']) ?></td>
			</tr>
			<tr>
				<td class="no-border" colspan="8">Please sign and return as authorisation that you would like to proceed with this Estimate,
					but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and
					Conditions it in their entirety.
				</td>
				<td colspan="4" class="no-border"></td>
			</tr>
		<?php } ?>
        <tr>
            <td class="no-border" style="padding: 30px 0;"></td>
            <td class="no-border" colspan="3"><strong>Customers Signature</strong></td>
            <td class="no-border" colspan="4" style="vertical-align: middle;">
                
            </td>
            <td class="no-border" colspan="4" style="vertical-align: bottom;">
                <span style="margin-right: 30px;">Date:</span>
                <span style="margin-right: 30px;"> / </span>
                <span style="margin-right: 30px;"> / </span>
            </td>

        </tr>
        <tr>
            <td colspan="3" style="border:1px #fff solid;"><strong>Notes to Customer:</strong></td>
            <td colspan="9" style="border:1px #fff solid;"><?= h($quote->notes_customer); ?></td>
        </tr>
    </table>
</div>

<?= $this->Html->script('/assets/js/jquery.app.js', ['block' => 'script']); ?>
<style>
@page {
    margin: 0.2cm 0.2cm 0.2cm 0.2cm;  
    }
</style>
<?= $this->Html->css('/assets/css/print.css', ['fullBase' => true]); ?>
