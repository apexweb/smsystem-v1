
<div class="row">

    <div class="col-sm-11">
        <h1>
            <small>SMS</small>
        </h1>
    </div>

    <div class="col-sm-1 text-right-not-xs">

        <?=
        $this->Html->link($this->Html->image('/assets/images/pdficon.png', ['alt' => 'PDF']),
            ['controller' => 'Quotes', 'action' => 'funnelwebpdf', $quote->id . '.pdf'],
            ['class' => 'pdflink', 'escape' => false]);
        ?>
    </div>

</div>


<div class="row">

    <div class="col-md-5 col-md-offset-3 col-sm-offset-0 font-13">

        <table class="table table-responsive invoice-table table-bordered">

            <tr class="darklight-greyborder">
                <th class="light-grey">Date:</th>
                <td class="text-center"><?= h($quote->created->format('d/m/Y')) ?></td>
            </tr>
            <tr>
                <th class="light-grey">Customer Name:</th>
                <td class="text-center"><?= h($quote->customer_name) ?></td>
            </tr>
            <tr>
                <th class="light-grey">Order No.:</th>
                <td class="text-center"><?= h($quote->qId) ?></td>
            </tr>


        </table>

        <table class="table table-responsive invoice-table table-bordered text-center">

            <tr>
                <th class="light-grey text-center width-150">Qty</th>
                <th class="light-grey text-center">Description of Goods</th>
            </tr>

            <?php
            $flagSecurity = false;
            $sum_doors = 0;
            $sum_windows = 0;

            foreach ($quote['products'] as $product) {

                if ($product->product_qty > 0) {
                    if ($product->product_window_or_door == 'Door') {
                        $sum_doors += $product->product_qty;
                    } else if ($product->product_window_or_door == 'Window') {
                        $sum_windows += $product->product_qty;
                    }
                    if ($product->product_sec_dig_perf_fibr == 'Security') {
                        $flagSecurity = true;
                    }
                }
            }
            ?>

            <tr>
                <td><?= $sum_windows ?></td>
                <td>Windows</td>
            </tr>

            <tr>
                <td><?= $sum_doors ?></td>
                <td>Doors</td>
            </tr>

            <?php foreach ($quote['accessories'] as $accessory): ?>

                <?php if ($accessory->accessory_each > 0): ?>

                    <tr>
                        <td><?= h($accessory->accessory_each) ?></td>
                        <td><?= h($accessory->accessory_name) ?></td>
                    </tr>

                <?php endif; ?>

            <?php endforeach; ?>


        </table>

        <table class="table table-responsive invoice-table table-bordered text-center">

            <tr>
                <th colspan="3" class="light-grey text-center">Additional Sections</th>
            </tr>


            <?php
            $sum_mtrs = 0;
            $sum_length = 0;

            foreach ($quote['additionalpermeters'] as $additionalpermeter) {

                if ($additionalpermeter->additional_per_meter > 0) {
                    $sum_mtrs += $additionalpermeter->additional_per_meter;
                }
            }

            foreach ($quote['additionalperlength'] as $additionalperlength) {
                if ($additionalperlength->additional_per_length > 0) {
                    $sum_length += $additionalperlength->additional_per_length;
                }
            }

            ?>


            <tr>
                <td><?= $sum_mtrs ?></td>
                <td>Meters</td>
                <td class="width-200"></td>
            </tr>

            <tr>
                <td><?= $sum_length ?></td>
                <td>Length</td>
                <td class="width-200"></td>
            </tr>

        </table>


        <table class="table table-responsive invoice-table table-bordered text-center">
            <tr>
                <th colspan="3" class="light-grey text-center">Custom Items</th>
            </tr>

            <?php foreach ($quote['customitems'] as $customitem): ?>

                <?php if ($customitem->custom_qty > 0 && $customitem->custom_tick): ?>

                    <tr>
                        <td><?= h($customitem->custom_qty) ?></td>
                        <td><?= h($customitem->custom_description) ?></td>
                        <td class="width-150"></td>
                    </tr>

                <?php endif; ?>


            <?php endforeach; ?>
        </table>


        <table class="table table-responsive invoice-table table-bordered text-center">

            <?php

            $total = $quote->invoiceCost;
            if ($flagSecurity) {
                $total = (float)$total + 8;
            }
            $additiona1 = $quote['invoice_second_1_price'];
            $additiona2 = $quote['invoice_second_2_price'];


            $final = round($total + $additiona1 + $additiona2, 0);

            //Funnel Web %2:
            $funnel_web = round($final * 2 / 100, 2);

            ?>

            <tr>
                <th class="light-grey text-right width-250">Amount Incl GST</th>
                <td colspan="2"><strong><span>$</span><span id="total-cost"><?= $total; ?></span></strong></td>
            </tr>

            <tr>
                <th class="light-grey text-right">Additional Costs Incl GST</th>
                <td>
                    <span><?= $quote->invoice_second_1_description ?></span>
                </td>
                <td class="width-100">
                    <span><?= $quote->invoice_second_1_price ?></span>
                </td>
            </tr>

            <tr>
                <th class="light-grey text-right">Freight/Delivery Incl GST</th>
                <td>
                    <span><?= $quote->invoice_second_2_description ?></span>
                </td>
                <td class="width-100">
                    <span><?= $quote->invoice_second_2_price ?></span>
                </td>
            </tr>

            <tr>
                <th class="light-grey text-right">Total Incl GST</th>
                <td colspan="2"><strong><span>$</span><span id="final-cost"><?= $final; ?></span></strong></td>
            </tr>

            <tr>
                <th class="light-grey text-right">SMS %2</th>
                <td colspan="2"><strong><span>$</span><span><?= $funnel_web; ?></span></strong></td>
            </tr>

        </table>

    </div>

</div>
