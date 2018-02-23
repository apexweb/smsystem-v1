<?php
$role = $quote->role;
$mfrole = $quote->mfrole;
$h1 = '';

if ($role == 'distributor' || $mfrole == 'distributor') {
    $h1 = 'Distributor Printout';
} else if ($role == 'wholesaler' || $mfrole == 'wholesaler') {
    $h1 = 'Wholesaler Printout';
} else if ($role == 'retailer' || $mfrole == 'retailer') {
    $h1 = 'Retailer Printout';
}

$flatCustomPrice = false;
$customQuotedAmount = 0;

if ($quote->override_final_price) {
    $flatCustomPrice = true;
    $customQuotedAmount = $quote->custom_quoted_amount;
}

?>


<div class="row">

    <div class="col-sm-11">
        <h1>
            <small><?= $h1 ?></small>
        </h1>
    </div>

    <div class="col-sm-1 text-right-not-xs">

        <?=
        $this->Html->link($this->Html->image('/assets/images/pdficon.png', ['alt' => 'PDF']),
            ['controller' => 'Quotes', 'action' => 'printoutpdf', $quote->id . '.pdf'],
            ['class' => 'pdflink', 'escape' => false]);
        ?>
    </div>

</div>


<div class="card-box font-13">

    <?php if ($quote->user->avatar): ?>
        <div class="text-center m-b-30">
            <?= $quote->user->printout ?>
        </div>
    <?php endif; ?>

    <table class="table table-responsive table-bordered small-padding">

        <tbody>
        <tr>
            <td><span style="font-size:1.2em;"><strong>Customer Name:</strong></span></td>
            <td colspan="3">
                <span id="customer-name" style="font-size:1.2em;">
                    <?= h($quote->customer_name) ?>
                </span>
            </td>
            <td><span><strong>Date:</strong></span></td>
            <td colspan="2">
                <span id="order-date">
                    <?= h($quote->created->format('d/m/Y')) ?>
                </span>
            </td>
            <td style="background:#5d9cec; color:#ffffff; vertical-align: bottom;"><strong>Order No. &nbsp; &nbsp;
                    <?= h($quote->qId) ?>
                </strong></td>
        </tr>
        <tr>
            <td><span><strong>Mobile:</strong></span></td>
            <td colspan="2"><span id="mobile">
                    <?= h($quote->mobile) ?>
                </span></td>
            <td><span><strong>Phone:</strong></span></td>
            <td colspan="4"><span id="phone">
                    <?= h($quote->phone) ?>
                </span></td>
        </tr>
        <tr>
            <td><span><strong>Email:</strong></span></td>
            <td colspan="7"><span id="email">
                    <?= h($quote->email) ?>
                </span></td>

        </tr>
        <tr>
            <td><span><strong>Address:</strong></span></td>
            <td colspan="7"><span id="street">
                    <?= h($quote->street) ?>
                </span></td>


        </tr>

        <tr>
            <td><span><strong>Suburb:</strong></span></td>
            <td colspan="3"><span id="suburb">
                    <?= h($quote->suburb) ?>
                </span></td>
            <td><span><strong>State:</strong></span></td>
            <td><span id="state">
                    <?= h($quote->state) ?>
                </span></td>
            <td><span><strong>Postcode:</strong></span></td>
            <td><span id="postcode">
                    <?= h($quote->postcode) ?>
                </span></td>

        </tr>

        </tbody>
    </table>

</div>

<div class="card-box">
    <table class="table table-responsive table-bordered quote-printout small-padding">
        <tr>
            <th class="width-50">NO</th>
            <th class="width-30">Qty - Panels</th>
            <th class="width-75">Product</th>
            <th class="width-75">Mesh Option</th>
            <th class="width-75">Fixture</th>
            <th class="width-80">Colour</th> 
            <th class="width-150">Config</th>
            <th class="width-250">Location / Notes</th>
            <th class="width-50">Hght mm</th>
            <th class="width-50">Wdth mm</th>
            <th>Lock Type</th>
            <th>Amount Incl GST</th>
        </tr>

        <?php foreach ($quote['products'] as $product): ?>
            <?php if ($product->product_qty > 0): ?>
                <tr>
                    <td><?= h($product->product_item_number) ?></td>
                    <td><?= h($product->product_qty) ?></td>
                    <td><?= h($product->product_sec_dig_perf_fibr) ?></td>
                    <td><?= h($product->product_316_ss_gal_pet) ?></td>
                    <td><?= h($product->product_window_or_door) ?></td>
                    <td><?= h($product->colour) ?></td>
                    <td><?= h($product->product_configuration) ?></td>
                    <td><?= h($product->product_location_in_building) ?></td>
                    <td><?= h($product->product_height) ?></td>
                    <td><?= h($product->product_width) ?></td>
                    <td><?= h($product->product_lock_type) ?></td>
                    <td>
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
            <td></td>
            <td>Qty</td>
            <td colspan="9" class="text-center"><strong>Sections and Accessories Required</strong></td>
            <td></td>
        </tr>
        <!--   Addtional Per Meters:     -->
        <?php foreach ($quote['additionalpermeters'] as $additionalpermeter): ?>
            <?php if ($additionalpermeter->additional_per_meter > 0): ?>
                <tr>
                    <td></td>
                    <td><?= h($additionalpermeter->additional_per_meter) ?></td>
                    <td colspan="9" class="text-center"><?= h($additionalpermeter->additional_name) ?>
                    <?php //pr($quote);?>
                    </td>
                    <td>
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
                    <td></td>
                    <td><?= h($additionalperlength->additional_per_length) ?></td>
                    <td colspan="9" class="text-center"><?= h($additionalperlength->additional_name) ?></td>
                    <td>
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
                    <td></td>
                    <td><?= h($accessory->accessory_each) ?></td>
                    <td colspan="9" class="text-center"><?= h($accessory->accessory_name) ?></td>
                    <td>
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
                    <td></td>
                    <td><?= h($customitem->custom_qty) ?></td>
                    <td colspan="9" class="text-center"><?= h($customitem->custom_description) ?></td>
                    <td>
                        <?php if (!$flatCustomPrice): ?>
                            <span>$</span><?= h($customitem->custom_charged); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        <tr>
            <td colspan="2"></td>
            <td colspan="8"></td>
            <td>Screen Total incl. GST</td>
            <td>
                <?php if (!$flatCustomPrice): ?>
                    <span>$</span><?= h($quote->total_sell_price - $quote->installation_total_cost); ?>
                <?php endif; ?>
            </td>
        </tr>

        <?php if (isset($quote->discount_amount) && $quote->discount_amount > 0 && (!$flatCustomPrice)): ?>
            <tr>
                <td colspan="2"></td>
                <td colspan="9"></td>
                <td>Discount Applied <?php if($quote->discount) echo ' - '. $quote->discount .'%';?></td>
                <td><span>$</span><?= h($quote->discount_amount); ?></td>
            </tr>
        <?php endif; ?>

        <tr>
            <td colspan="2"></td>
            <td colspan="8" class="text-center"><strong>Colour</strong></td>
            <td>Installation</td>
            <td>
                <?php if (!$flatCustomPrice): ?>
                    <span>$</span><?= h($quote->installation_total_cost); ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="8" class="text-center quote-colors">

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
            <td style="vertical-align: middle;"><strong>Final Amount</strong></td>
            <td style="vertical-align: middle;">
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
            <td colspan="8"></td>
            <td>Deposit Amount</td>
            <td>

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
        <tr>
            <td colspan="4">*Estimate is subject to check measure</td>
            <td colspan="4">*Installation includes any freight/delivery charges if applicable</td>
            <td colspan="2">Bank Details</td>
            <td>Bank</td>
            <td><?= h($authUser['bank_name']) ?></td>
        </tr>
        <tr>
            <td colspan="4">*This estimate is valid for 30 days*</td>
            <td colspan="6"><strong>Please use the Order No as your payment reference</strong></td>
            <td>Account Name</td>
            <td><?= h($authUser['bank_account_name']) ?></td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td>BSB</td>
            <td><?= h($authUser['bsb']) ?></td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td>Acc No.</td>
            <td><?= h($authUser['bank_account_number']) ?></td>
        </tr>
        <tr>
            <td colspan="8">Please sign and return as authorisation that you would like to proceed with this Estimate,
                but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and
                Conditions it in their entirety.
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td style="padding: 40px 0;"></td>
            <th colspan="2">Customers Signature</th>
            <td></td>
            <td colspan="4" style="vertical-align: middle;">
                <hr/>
            </td>
            <td colspan="4" style="vertical-align: bottom;">
                <span style="margin-right: 30px;">Date:</span>
                <span style="margin-right: 30px;"> / </span>
                <span style="margin-right: 30px;"> / </span>
            </td>

        </tr>
        <tr>
            <td colspan="3"><strong>Notes to Customer:</strong></td>
            <td colspan="10"><?= h($quote->notes_customer); ?></td>
        </tr>
    </table>
</div>
