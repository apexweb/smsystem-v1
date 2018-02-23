<?php

$role = $quote['role'];
$mfrole = $quote['mfrole'];
$h1 = 'Invoice';

if ($role == 'distributor' || $mfrole == 'distributor') {
    $h1 = 'Distributor Invoice';
} else if ($role == 'wholesaler' || $mfrole == 'wholesaler') {
    $h1 = 'Wholesaler Invoice';
} else if ($role == 'retailer' || $mfrole == 'retailer') {
    $h1 = 'Retailer Invoice';
}
$selected_fields = "";
if(isset($fieldSettings->meta_value) && $fieldSettings->meta_value != '') {
    $selected_fields = unserialize(base64_decode($fieldSettings->meta_value));
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
                ['controller' => 'Quotes', 'action' => 'invoicepdf', $quote->id . '.pdf'],
                ['class' => 'pdflink', 'escape' => false]);
            ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-5 col-md-offset-3 col-sm-offset-0 font-13">

            <h3 class="text-center">Invoice Amount</h3>

            <table class="table table-responsive invoice-table table-bordered ">

                <tr class="darklight-greyborder">
                    <th class="light-grey">Date:</th>
                    <td class="text-center"><?= h($quote->created->format('d/m/Y')) ?></td>
                    <td class="width-150"></td>
                </tr>
                <tr>
                    <th class="light-grey">Created By:</th>
                    <td class="text-center"><?= h($quote->user->username) ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="light-grey">Customer Name:</th>
                    <td class="text-center"><?= h($quote->customer_name) ?></td>
                    <td></td>
                </tr>
                <tr>
                    <th class="light-grey">Order No.:</th>
                    <td class="text-center"><?= h($quote->qId) ?></td>
                    <td></td>
                </tr>


            </table>

            <table class="table table-responsive invoice-table table-bordered text-center">

                <tr>
                    <!--<th class="light-grey text-center width-150">Qty</th>
                    <th class="light-grey text-center">Description of Goods</th>-->
                    <?php
                        if(isset($selected_fields['settings']['products']['value']) && !empty($selected_fields['settings']['products']['value'])){
                            foreach($selected_fields['settings']['products']['value'] as $name => $val) {
                                if($val == 1){ ?>
                                    <th class="light-grey text-center"><?= $selected_fields['settings']['products']['label'][$name] ?></th>
                        <?php   }
                            }
                        }
                    ?>
                </tr>

                <?php
                $flagSecurity = false;
                $sum_doors = 0;
                $sum_windows = 0;


                foreach ($quote['products'] as $product) {

                    /*if ($product->product_qty > 0) {
                        if ($product->product_window_or_door == 'Door') {
                            $sum_doors += $product->product_qty;
                        } else if ($product->product_window_or_door == 'Window') {
                            $sum_windows += $product->product_qty;
                        }
                        if ($product->product_sec_dig_perf_fibr == 'Security') {
                            $flagSecurity = true;
                        }
                    }*/
                    ?>
                    <tr>
                        <?php
                        if(isset($selected_fields['settings']['products']['value']) && !empty($selected_fields['settings']['products']['value'])){
                            foreach($selected_fields['settings']['products']['value'] as $name => $val) {
                                if($val == 1){ ?>
                                    <td><?= $product->$name ?></td>
                        <?php   }
                            }
                        }
                        ?>
                    </tr>
                    <?php
                }


                ?>

                <!--<tr>
                    <td><?//= $sum_windows ?></td>
                    <td>Windows</td>
                </tr>

                <tr>
                    <td><?//= $sum_doors ?></td>
                    <td>Doors</td>
                </tr>-->

                <table class="table table-responsive invoice-table table-bordered text-center">
                    <tr>
                        <th colspan="3" class="light-grey text-center">Accessories</th>
                    </tr>
                    <?php foreach ($quote['accessories'] as $accessory): ?>

                        <?php if ($accessory->accessory_each > 0): ?>

                            <tr>
                                <?php
                                if(isset($selected_fields['settings']['accessories']['value']) && !empty($selected_fields['settings']['accessories']['value'])){
                                    foreach($selected_fields['settings']['accessories']['value'] as $name => $val) {
                                        if($val == 1){ ?>
                                            <td><?= $accessory->$name ?></td>
                                <?php   }
                                    }
                                }
                                ?>
                                <!--<td><?//= h($accessory->accessory_each) ?></td>
                                <td><?//= h($accessory->accessory_name) ?></td>
                                <td class="width-150"></td>-->
                            </tr>

                        <?php endif; ?>


                    <?php endforeach; ?>

                </table>


            </table>

            <table class="table table-responsive invoice-table table-bordered text-center">

                <tr>
                    <th colspan="3" class="light-grey text-center">Additional Sections</th>
                </tr>
                <tr>
                    <th colspan="3" class="light-grey text-center">Additional Sections Per Meter</th>
                </tr>

                <?php
                $sum_mtrs = 0;
                $sum_length = 0;

                foreach ($quote['additionalpermeters'] as $additionalpermeter) {

                    /*if ($additionalpermeter->additional_per_meter > 0) {
                        $sum_mtrs += $additionalpermeter->additional_per_meter;
                    }*/
                    ?>
                    <tr>
                        <?php
                        if(isset($selected_fields['settings']['additional_per_meter']['value']) && !empty($selected_fields['settings']['additional_per_meter']['value'])){
                            foreach($selected_fields['settings']['additional_per_meter']['value'] as $name => $val) {
                                if($val == 1){ ?>
                                    <td><?= $additionalpermeter->$name ?></td>
                        <?php   }
                            }
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
                <?php
                    if(isset($selected_fields['settings']['additional_per_length']['value']) && !empty($selected_fields['settings']['additional_per_length']['value'])){
                        $colspan = array_count_values($selected_fields['settings']['additional_per_length']['value']);
                        $colspanval = (isset($colspan[1])) ? $colspan[1] : 1;
                    }
                ?>
                <tr>
                    <th colspan="3" class="light-grey text-center">Additional Sections Per Length</th>
                </tr>
                <?php
                foreach ($quote['additionalperlength'] as $additionalperlength) {
                    /*if ($additionalperlength->additional_per_length > 0) {
                        $sum_length += $additionalperlength->additional_per_length;
                    }*/
                    ?>
                    <tr>
                        <?php
                        if(isset($selected_fields['settings']['additional_per_length']['value']) && !empty($selected_fields['settings']['additional_per_length']['value'])){
                            foreach($selected_fields['settings']['additional_per_length']['value'] as $name => $val) {
                                if($val == 1){ ?>
                                    <td><?= $additionalperlength->$name ?></td>
                        <?php   }
                            }
                        }
                        ?>
                    </tr>
                <?php
                }

                ?>


                <!--<tr>
                    <td><?//= $sum_mtrs ?></td>
                    <td>Meters</td>
                    <td class="width-200"></td>
                </tr>

                <tr>
                    <td><?//= $sum_length ?></td>
                    <td>Length</td>
                    <td class="width-200"></td>
                </tr>-->

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

            <?= $this->Form->create($quote); ?>
            <table class="table table-responsive invoice-table table-bordered text-center">

                <?php

                $total = $quote->invoiceCost;
                if ($flagSecurity) {
                    $total = (float)$total + 8;
                }

                $additiona1 = $quote['invoice_second_1_price'];
                $additiona2 = $quote['invoice_second_2_price'];


                $final = round($total + $additiona1 + $additiona2, 0);

                ?>

                <tr>
                    <th class="light-grey text-right width-250">Amount Incl GST</th>
                    <td colspan="3"><strong><span>$</span><span id="total-cost"><?= $total; ?></span></strong></td>

                </tr>

                <tr>
                    <th class="light-grey text-right">Additional Costs Incl GST</th>
                    <td>
                        <?= $this->Form->input('invoice_second_1_description',
                            ['class' => 'form-control input-sm', 'label' => false, 'placeholder' => 'Description']) ?>
                    </td>
                    <td class="width-100">
                        <?= $this->Form->input('invoice_second_1_price',
                            ['class' => 'form-control input-sm', 'label' => false, 'placeholder' => 'Price']) ?>
                    </td>

                </tr>

                <tr>
                    <th class="light-grey text-right">Freight/Delivery Incl GST</th>
                    <td>
                        <?= $this->Form->input('invoice_second_2_description',
                            ['class' => 'form-control input-sm', 'label' => false, 'placeholder' => 'Description']) ?>
                    </td>
                    <td class="width-100">
                        <?= $this->Form->input('invoice_second_2_price',
                            ['class' => 'form-control input-sm', 'label' => false, 'placeholder' => 'Price']) ?>
                    </td>
                </tr>

                <tr>
                    <th class="light-grey text-right">Total Incl GST</th>
                    <td colspan="2"><strong><span>$</span><span id="final-cost"><?= $final; ?></span></strong></td>
                </tr>

            </table>

            <?= $this->Form->Button('SAVE CHANGES', ['class' => 'btn btn-success waves-effect']) ?>

            <?= $this->Form->end() ?>
        </div>

    </div>

<?= $this->Html->script('invoice.js', ['block' => 'script']); ?>