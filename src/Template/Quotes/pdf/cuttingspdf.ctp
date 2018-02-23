<div class="row">
    <div class="card-box cuttings-customer-info font-13">
       
        <table class="table small-padding">
            <tr>
                <td width="20%" class="no-border"><strong>Cutting Schedule</strong></td>
                <td width="20%" class="no-border"><span>Created By: </span><span class="big-span"><?= h($quote->user->username) ?></span></td>
                <td width="20%" class="no-border"><span>Cust. Order No. </span> <span class="big-span"><?= h($quote->qId) ?></span></td>
                <td width="20%" class="no-border">
                    <span>Date Ordered: </span> 
                    <?php
                    if ($quote->orderin_date != null) {
                        echo '<span class="big-span">' . h($quote->orderin_date) . '</span>';
                    }
                    ?>
                </td>
                <td width="20%" class="no-border right-align">
                    <span>Date Required: </span>
                    <?php
                    if ($quote->required_date != null) {
                        echo '<span class="big-span">' . h($quote->required_date) . '</span>';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="no-border">
                    <span>Notes to Manufacturer: </span>
                    <span class="big-span"><?= h($quote->notes_manufacturer) ?></span>
                </td>
            </tr>
        </table>       
    </div>

</div>

    <div class="row">
        <div class="card-box table-responsive">
            <table class="table table-bordered cuttings-table small-padding" style="margin-bottom:5px;">
                <!--          15  -->
                <tr>
                    <th class="vertical-middle"></th>
                    <th colspan="12" class="text-center"><span class="font-18"><b><?= h($quote->customer_name) ?></b></span>
                    </th>
                    <th colspan="5"></th>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td colspan="4" class="vertical-middle text-center">
                        Frame
                    </td>
                    <td colspan="8" class="vertical-middle text-center">
                        <?php if ($quote->standard) {
                            echo '<p class="no-margin"><b>' . h($quote->standard_color) . '</b></p>';
                        }
                        ?>
                        <?php if ($quote->color1) {
                            echo '<p class="no-margin"><b>' . h($quote->color1_color) . '</b></p>';
                        }
                        ?>
                        <?php if ($quote->color2) {
                            echo '<p class="no-margin"><b>' . h($quote->color2_color) . '</b></p>';
                        }
                        ?><?php if ($quote->color3) {
                            echo '<p class="no-margin"><b>' . h($quote->color3_color) . '</b></p>';
                        }
                        ?><?php if ($quote->color4) {
                            echo '<p class="no-margin"><b>' . h($quote->color4_color) . '</b></p>';
                        }
                        ?>
                    </td>
                    <td colspan="5" class="text-center vertical-middle">SECOND POWDERCOAT REQUIRED:
                        <span style="color: #161616;">
                        <?php if ($quote->second_color_required) {
                            echo '<b>YES</b>';
                        } else {
                            echo '<b>NO</b>';
                        } ?>
                    </span>
                    </td>
                </tr>


                <tr>
                    <th class="width-80">ITEM</th>
                    <th class="width-10" style="width:10px;">PNL QTY</th>
                    <th colspan="2" class="width-290">CONFIGURATION</th>
                    <th class="width-90">WIN OR DOOR</th>
                    <th class="width-60">MIDRAIL</th>
                    <th class="width-90">COLOUR</th>
                    <th class="width-60">FRAME</th>
                    <th class="qty">QTY</th>
                    <th class="x"></th>
                    <th class="height">HEIGHT</th>
                    <th class="qty">QTY</th>
                    <th class="x"></th>
                    <th class="height">WIDTH</th>
                    <th colspan="2" class="width-80">LOCK TYPE</th>
                    <th class="height">HH</th>
                    <th class="width-200">LOC / NOTES / COLOURS</th>

                </tr>

                <?php
                $locks_qty_sum = 0;
                $total_sum_door = 0;
                $total_sum_window = 0;
                ?>

                <?php foreach ($quote['products'] as $product): ?>
                    <?php if ($product->product_qty > 0): ?>
                        <tr>
                            <?php
                            $qty_2 = 0;
                            $qty_2 = $product->product_qty * 2;
                            ?>
                            <td><?= h($product->product_item_number) ?></td>
                            <td><?= h($product->product_qty) ?></td>
                            <td class="max-space"><?= h($product->product_configuration) ?></td>
                            <td><?= h($product->product_sec_dig_perf_fibr) ?></td>
                            <td><?= h($product->product_window_or_door) ?></td>
                            <td class="text-center"><?= ($product->product_inc_midrail)?'Y':'N' ?></td>
                            <td><?= h($product->colour) ?></td>
                            <td><?= h($product->product_window_frame_type) ?></td>
                            <td class="text-right"><?= $qty_2 ?></td>
                            <td class="at"><small>@</small></td>
                            <td><?= h($product->product_height) ?></td>
                            <td class="text-right"><?= $qty_2 ?></td>
                            <td class="at"><small>@</small></td>
                            <td><?= h($product->product_width) ?></td>
                            <td colspan="2"><?= h($product->product_lock_type) ?></td>
                            <td><?= h($product->product_lock_handle_height) ?></td>
                            <td><?= h($product->product_location_in_building) ?></td>

                            <?php
                            $locks_qty_sum += $product->product_number_of_locks;
                            if ($product->product_window_or_door == 'Door') {
                                $total_sum_door += $product->product_qty;
                            } elseif ($product->product_window_or_door == 'Window') {
                                $total_sum_window += $product->product_qty;
                            }
                            ?>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>

                <tr>
                    <td colspan="18"></td>
                </tr>

                <?php foreach ($quote['midrails'] as $midrail): ?>
                    <?php if ($midrail->midrail_qty > 0): ?>
                        <tr>
                            <td colspan="3"></td>
                            <th colspan="2">Width</th>
                            <td><?= h($midrail->midrail_width) ?></td>
                            <th colspan="2">Height</th>
                            <td><?= h($midrail->midrail_height) ?></td>
                            <th colspan="2">Rail</th>
                            <td>
                                <?php
                                if ($midrail->midrail_sec_dig_perf_fibr == 'Security' && $midrail->midrail_window_or_door == 'Door') {
                                    $product_rail = $midrail->midrail_width - 120 + $midrail->midrail_height - 120;
                                    echo $product_rail;
                                } else if ($midrail->midrail_sec_dig_perf_fibr == 'Security' && $midrail->midrail_window_or_door == 'Window') {
                                    $product_rail = $midrail->midrail_width - 75 + $midrail->midrail_height - 75;
                                    echo $product_rail;
                                } else {
                                    echo 0;
                                }
                                ?>
                            </td>
                            <td>Cover</td>
                            <td>
                                <?php
                                if ($midrail->midrail_sec_dig_perf_fibr == 'Security' && $midrail->midrail_window_or_door == 'Door') {
                                    $product_cover = $midrail->midrail_width - 154 + $midrail->midrail_height - 154;
                                    echo $product_cover;
                                } else if ($midrail->midrail_sec_dig_perf_fibr == 'Security' && $midrail->midrail_window_or_door == 'Window') {
                                    $product_cover = $midrail->midrail_width - 105 + $midrail->midrail_height - 105;
                                    echo $product_cover;
                                } else {
                                    echo 0;
                                }
                                ?>
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered small-padding" style="margin-bottom:5px;">
                <tr>
                    <th colspan="5" class="text-center">Additional Sections Cut Sheet</th>
                </tr>
                <tr>
                    <th class="qty">Qty</th>
                    <th>Section</th>
                    <th>Colour</th>
                    <th>Cut to size mm</th>
                    <th>Notes</th>
                </tr>
                <?php if (count($quote->cutsheets) > 0): ?>
                    <?php foreach ($quote->cutsheets as $cutsheet): ?>
                        <?php if ($cutsheet->qty > 0): ?>
                            <tr>
                                <td><?= $cutsheet->qty ?></td>
                                <td><?= $cutsheet->section ?></td>
                                <td><?= $cutsheet->colour ?></td>
                                <td><?= $cutsheet->cut_to_size ?></td>
                                <td><?= $cutsheet->notes ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>

<div class="row">
    <div class="col-12">
        <table class="table small-padding">
            <tr>
                <td style="width:33%;" class="no-border">
                    <div class="row">
                        <table class="table table-bordered quote-installsheet small-padding">
                            <tr>
                                <th class="20_per">ITEM NO</th>
                                <th class="20_per">PER METER</th>
                                <th>ADDITIONAL SECTION</th>
                            </tr>

                            <?php foreach ($quote['additionalpermeters'] as $additionalpermeter): ?>
                                <?php if ($additionalpermeter->additional_per_meter > 0): ?>
                                    <tr>
                                        <td><?= h($additionalpermeter->additional_item_number); ?></td>
                                        <td><?= h($additionalpermeter->additional_per_meter) ?></td>
                                        <td><?= h($additionalpermeter->additional_name) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>   
                    </div>
                </td>
                <td style="width:33%;" class="no-border">
                    <div class="row">
                        <table class="table table-bordered quote-installsheet small-padding">
                            <tr>
                                <th class="20_per">ITEM NO</th>
                                <th class="20_per">LENGTH</th>
                                <th>ADDITIONAL SECTION</th>
                            </tr>

                            <?php foreach ($quote['additionalperlength'] as $additionalperlength): ?>
                                <?php if ($additionalperlength->additional_per_length > 0): ?>
                                    <tr>
                                        <td><?= h($additionalperlength->additional_item_number); ?></td>
                                        <td><?= h($additionalperlength->additional_per_length) ?></td>
                                        <td><?= h($additionalperlength->additional_name) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </td>
                <td style="width:33%;" class="no-border">
                    <div class="row">
                        <table class="table table-bordered quote-installsheet small-padding">
                            <tr>
                                <th class="20_per">ITEM NO</th>
                                <th class="20_per">EACH</th>
                                <th>ACCESSORIES</th>
                            </tr>

                            <?php foreach ($quote['accessories'] as $accessory): ?>
                                <?php if ($accessory->accessory_each > 0): ?>
                                    <tr>
                                        <td><?= h($accessory->accessory_item_number) ?></td>
                                        <td><?= h($accessory->accessory_each) ?></td>
                                        <td><?= h($accessory->accessory_name) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </td>                
            </tr>
        </table> 
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table small-padding table-responsive">
            <tr>
                <td width="65%" class="no-border">
                        <table class="table table-bordered small-padding">
                            <tr>
                                <th colspan="9" class="text-center"><?= h($quote->customer_name) ?></th>
                            </tr>

                            <tr>
                                <th class="text-center" colspan="9">MESH</th>
                            </tr>

                            <tr>
                                <th colspan="2"></th>
                                <th>SEC - PERF - DG</th>
                                <th></th>
                                <th class="qty">QTY</th>
                                <th class="x"></th>
                                <th class="height">HEIGHT</th>
                                <th class="x"></th>
                                <th class="width">WIDTH</th>
                            </tr>

                            <?php foreach ($quote['products'] as $product): ?>

                                <tr>
                                    <td><?= h($product->product_item_number) ?></td>
                                    <td class="qty"><?= h($product->product_qty) ?></td>
                                    <td><?= h($product->product_sec_dig_perf_fibr) ?></td>
                                    <td><?= h($product->product_316_ss_gal_pet) ?></td>
                                    <td><?= h($product->product_qty) ?></td>
                                    <td>x</td>
                                    <td><?php

                                        if ($product->product_sec_dig_perf_fibr == '316 S/S') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo ($product->product_height - $deductions['sd_deduction']);
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo ($product->product_height - $deductions['sw_deduction']);
                                            }
                                        } else if ($product->product_sec_dig_perf_fibr == 'D/Grille') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo $product->product_height - $deductions['dd_deduction'];
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo $product->product_height - $deductions['dw_deduction'];
                                            }
                                        } else if ($product->product_sec_dig_perf_fibr == 'Insect') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo ($product->product_height - $deductions['id_deduction']);
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo ($product->product_height - $deductions['iw_deduction']);
                                            }
                                        } else if ($product->product_sec_dig_perf_fibr == 'Perf') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo ($product->product_height - $deductions['pd_deduction']);
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo ($product->product_height - $deductions['pw_deduction']);
                                            }
                                        }

                                        ?>
                                    </td>

                                    <td>x</td>

                                    <td><?php

                                        if ($product->product_sec_dig_perf_fibr == '316 S/S') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo $product->product_width - $deductions['sd_deduction'];
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo $product->product_width - $deductions['sw_deduction'];
                                            }
                                        } else if ($product->product_sec_dig_perf_fibr == 'D/Grille') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo $product->product_width - $deductions['dd_deduction'];
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo $product->product_width - $deductions['dw_deduction'];
                                            }
                                        } else if ($product->product_sec_dig_perf_fibr == 'Insect') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo $product->product_width - $deductions['id_deduction'];
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo $product->product_width - $deductions['iw_deduction'];
                                            }
                                        } else if ($product->product_sec_dig_perf_fibr == 'Perf') {
                                            if ($product->product_window_or_door == 'Door') {
                                                echo $product->product_width - $deductions['pd_deduction'];
                                            } else if ($product->product_window_or_door == 'Window') {
                                                echo $product->product_width - $deductions['pw_deduction'];
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                </td>
                <td width="35%" class="no-border">
                        <table class="table table-bordered quote-installsheet small-padding">
                            <tr>
                                <th class="qty">QTY</th>
                                <th>CUSTOM ITEM</th>
                            </tr>

                            <?php foreach ($quote['customitems'] as $customitem): ?>
                                <?php if ($customitem->custom_qty > 0 && $customitem->custom_tick): ?>
                                    <tr>
                                        <td><?= h($customitem->custom_qty) ?></td>
                                        <td><?= h($customitem->custom_description) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>                        
                </td>
            </tr>
        </table>
    </div>
</div>


<?php if (false): ?>
<div class="row">
    <table class="table table-bordered table-bold table-striped small-padding">

        <tr>
            <th style="font-size: 18px;" class="text-center" colspan="4">SCREENGUARD JOB SHEET</th>

        </tr>

        <tr>
            <th>DATE:</th>
            <td><?= h($quote->created->format('d/m/Y')) ?></td>
            <th>DATE REQUIRED:</th>
            <td>
                <?php
                if ($quote->required_date != null) {
                    echo '<span>' . h($quote->required_date) . '</span>';
                }
                ?>
            </td>

        </tr>

        <tr>
            <th>CUSTOMER NAME:</th>
            <td colspan="3"><?= h($quote->customer_name) ?></td>
        </tr>

        <tr>
            <th>CUSTOMER ORDER NO.</th>
            <td colspan="3"><?= h($quote->qId); ?></td>
        </tr>

        <tr>
            <th colspan="1">QTY</th>
            <th colspan="3">DESCRIPTION OF GOODS</th>
        </tr>


        <tbody style="font-size: 13px;">

        <tr>
            <th colspan="4">Panels</th>
        </tr>

        <tr>
            <td><?= $total_sum_door ?></td>
            <td colspan="3">Doors</td>
        </tr>
        <tr>
            <td><?= $total_sum_window ?></td>
            <td colspan="3">Windows</td>
        </tr>

        <tr>
            <th colspan="4" class="text-center">ADDITIONAL SECTIONS PER METER</th>
        </tr>

        <?php foreach ($quote['additionalpermeters'] as $additionalpermeter): ?>
            <?php if ($additionalpermeter->additional_per_meter > 0): ?>
                <tr>
                    <td><?= h($additionalpermeter->additional_per_meter) ?></td>
                    <td colspan="3"><?= h($additionalpermeter->additional_name) ?></td>
                </tr>

            <?php endif; ?>

        <?php endforeach; ?>

        <tr>
            <th colspan="4" class="text-center">ADDITIONAL SECTIONS PER LENGTH</th>
        </tr>

        <?php foreach ($quote['additionalperlength'] as $additionalperlength): ?>
            <?php if ($additionalperlength->additional_per_length > 0): ?>
                <tr>
                    <td><?= h($additionalperlength->additional_per_length) ?></td>
                    <td colspan="3"><?= h($additionalperlength->additional_name) ?></td>
                </tr>

            <?php endif; ?>

        <?php endforeach; ?>

        <tr>
            <th colspan="4" class="text-center">CUSTOM ITEM</th>
        </tr>

        <?php foreach ($quote['customitems'] as $customitem): ?>
            <?php if ($customitem->custom_qty > 0 && $customitem->custom_tick): ?>
                <tr>
                    <td><?= h($customitem->custom_qty) ?></td>
                    <td colspan="3"><?= h($customitem->custom_description) ?></td>
                </tr>

            <?php endif; ?>

        <?php endforeach; ?>

        <tr>
            <th colspan="4" class="text-center">ACCESSORIES</th>
        </tr>

        <?php foreach ($quote['accessories'] as $accessory): ?>
            <?php if ($accessory->accessory_each > 0): ?>
                <tr>
                    <td><?= h($accessory->accessory_each) ?></td>
                    <td colspan="3"><?= h($accessory->accessory_name) ?></td>
                </tr>

            <?php endif; ?>

        <?php endforeach; ?>


        </tbody>
        <tr>
            <th>Date Completed
            </th>
            <td colspan="3"></td>
        </tr>

        <tr>
            <th>Panels No.s
            </th>
            <td colspan="3"></td>
        </tr>

        <tr>
            <th>Additional Sections Per Meter
            </th>
            <td colspan="3"></td>
        </tr>

        <tr>
            <th>Additional Sections Per Length
            </th>
            <td colspan="3"></td>
        </tr>


        <tr>
            <th>Accessories
            </th>
            <td colspan="3"></td>
        </tr>

        <tr>
            <th>Signed Off By
            </th>
            <td colspan="3"></td>
        </tr>


    </table>
</div>

<?php endif; ?>
<style>
@page {
    margin: 0.2cm;  
    }
</style>





