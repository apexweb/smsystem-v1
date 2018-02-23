<h1>
    <small>Check Measure/Install Sheet</small>
</h1>
<div class="row">
    <div class="card-box cuttings-customer-info font-13">
        <table class="table table-responsive noborder" border="0">
            <tr>
                <td colspan="5" align="right">
                    <?= h($quote->created->format('d/m/Y')) ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Created By:
                    <span><strong><?= h($quote->user->username) ?></strong></span>                    
                </td>
                <td colspan="2">
                    Cust. Order No.
                    <span><strong><?= h($quote->qId) ?></strong></span>                    
                </td>
                <td align="right">
                    Date Required:
                        <span><strong>
                            <?php if ($quote->required_date != null) {
                                echo h($quote->required_date);
                            }; ?>
                        </strong></span> 
                </td>
            </tr>
                <tr>
                    <td>
                        Name:
                        <span><strong><?= h($quote->customer_name) ?></strong></span>                    
                    </td>
                    <td>
                        Home Phone:
                        <span><strong><?= h($quote->phone) ?></strong></span>                    
                    </td>
                    <td>
                        Ph. No:
                        <span><strong><?= h($quote->mobile) ?></strong></span>                    
                    </td>
                    <td colspan="2">
                        Street:
                        <span><strong><?= h($quote->street . ' ' . $quote->suburb) ?></strong></span>                    
                    </td>                    
                </tr>
                <tr>
                    <td colspan="5">
                        Colour:
                        <span class="colors-td"><strong>
                            <?php if ($quote->standard) {
                                echo h($quote->standard_color);
                            }
                            if ($quote->color1) {
                                echo h($quote->color1_color);
                            }
                            if ($quote->color2) {
                                echo h($quote->color2_color);
                            }
                            if ($quote->color3) {
                                echo h($quote->color3_color);
                            }
                            if ($quote->color4) {
                                echo h($quote->color4_color);
                            }
                            ?>
                        </strong></span>                    
                    </td>                
                </tr>
        </table>
    </div>
</div>


    <div class="card-box printout">
        <table class="table table-responsive table-bordered quote-printout small-padding heading-bg">
            <tr class="th-bg">
                <th class="text-center width-30">ITEM</th>
                <th class="text-center qty">QTY</th>
                <th class="text-center width-150">LOCATION</th>
                <th colspan="2" class="text-center width-120">CONFIGURATION</th>
                <th class="text-center width-40">WIN OR DR</th>
                <th class="text-center width-80">COLOUR</th>
                <th class="text-center width-30">FRAME</th>
                <th class="text-center height">HEIGHT</th>
                <th class="width-30"></th>
                <th class="text-center width">WIDTH</th>
                <th class="width-30"></th>
                <th class="text-center height">HANDLE HEIGHT</th>
                <!--            <th>NOTE</th>-->
            </tr>
            <?php foreach ($quote['products'] as $product): ?>
                <?php if ($product->product_qty > 0): ?>
                    <tr>
                        <td class="text-center"><?= h($product->product_item_number) ?></td>
                        <td class="text-center"><?= h($product->product_qty) ?></td>
                        <td><?= h($product->product_location_in_building) ?></td>

                        <td class="width-100"><?= h($product->product_configuration) ?></td>
                        <td class="width-20 text-center">
                            <?php
                            echo h($product->product_sec_dig_perf_fibr);
                            ?>
                        </td>

                        <td class="text-center"><?= h($product->product_window_or_door) ?></td>
                        <td class="text-center" class="width-30"><?= h($product->colour) ?></td>
                        <td class="text-center"><?= h($product->product_window_frame_type) ?></td>
                        <td class="text-center"><?= h($product->product_height) ?></td>
                        <td class="width-10">&nbsp;</td>
                        <td class="text-center"><?= h($product->product_width) ?></td>
                        <td class="width-10">&nbsp;</td>
                        <td class="text-center"><?= h($product->product_lock_handle_height) ?></td>
                        <!--                <td></td>-->
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>            
        </table>
    </div>
    <br>
    <div class="row">        
        <table class="table small-padding">
            <tr>
                <td width="33.3%;" class="no-border">                    
                    <table class="table table-responsive table-bordered quote-printout small-padding heading-bg" style="margin-bottom: 0px;">
                        <tr>
                            <th class="width-50">PER METER</th>
                            <th>ADDITIONAL SECTION</th>
                        </tr>

                        <?php foreach ($quote['additionalpermeters'] as $additionalpermeter): ?>
                            <?php if ($additionalpermeter->additional_per_meter > 0): ?>
                                <tr>
                                    <td><?= h($additionalpermeter->additional_per_meter) ?></td>
                                    <td><?= h($additionalpermeter->additional_name) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>                    
                </td>
                <td width="33.3%;" class="no-border">
                   
                    <table class="table table-responsive table-bordered quote-printout small-padding heading-bg">
                        <tr>
                            <th class="width-50">PER FULL LENGTH</th>
                            <th>ADDITIONAL SECTION</th>
                        </tr>

                        <?php foreach ($quote['additionalperlength'] as $additionalperlength): ?>
                            <?php if ($additionalperlength->additional_per_length > 0): ?>
                                <tr>
                                    <td><?= h($additionalperlength->additional_per_length) ?></td>
                                    <td><?= h($additionalperlength->additional_name) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                   
                </td>
                <td width="33.3%;" class="no-border">
                    
                    <table class="table table-responsive table-bordered quote-printout small-padding heading-bg">
                        <tr>
                            <th class="width-50">EACH</th>
                            <th>ACCESSORIES</th>
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
                    
                </td>
            </tr>
            <tr>
                <td class="no-border" style="vertical-align:top;" >

                    <table class="table table-responsive table-bordered quote-printout small-padding heading-bg" >
                        <tr>
                            <th class="width-50">QTY</th>
                            <th>CUSTOM ITEM</th>
                        </tr>

                        <?php foreach ($quote['customitems'] as $customitem): ?>
                            <?php if ($customitem->custom_qty > 0): ?>
                                <tr>
                                    <td><?= h($customitem->custom_qty) ?></td>
                                    <td><?= h($customitem->custom_description) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>

                </td>
                <td colspan="2" class="no-border"></td>
            </tr>
        </table>       
    </div>   
    
   

<div class="card-box" >
    <div class="installsheet-notes">
        <p><strong>Notes</strong></p>
        <hr class="small-margin">
        <p><?= h($quote->notes) ?></p>
    </div>

    <div class="installsheet-notes">
        <p><strong>Notes to the Installer</strong></p>
        <hr class="small-margin">
        <p><?= h($quote->notes_installer) ?></p>
    </div>


    <?php if ($quote->installation_cost_include_on_check_measure): ?>
        <div class="installsheet-notes">
            <p><strong>Installation Total</strong></p>
            <hr class="small-margin">
            <p><?= h($quote->installation_total_cost) ?></p>
        </div>
    <?php endif; ?>
</div>
<style>
@page {
    margin: 0.2cm 0.3cm 0.2cm 0.2cm;  
    }
    
</style>
<?= $this->Html->css('/assets/css/print.css', ['fullBase' => true]); ?>
