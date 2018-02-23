<?php

$standards = [];
$color1 = [];
$color2 = [];
$color3 = [];
$color4 = [];
$conf = [];


$additional_per_meter = [];
$additional_per_length = [];
$accessories = [];
$mc_parts = [];
$colours = [];

$StandardColor = $Anodized = $CustomColour = $PremiumColour = $SpecialColour = [];

foreach ($dropdowns as $dropdown) {
    $name = $dropdown->name;
    if ($dropdown->type == 'Standard Color') {
        $standards[$name] = $name;
        $StandardColor['Standard Color|'.$name] = $name;
    } else if ($dropdown->type == 'Color 1') {
        $color1[$name] = $name;
        $CustomColour['Custom Colour|'.$name] = $name;
    } else if ($dropdown->type == 'Color 2') {
        $color2[$name] = $name;
        $PremiumColour['Premium Colour|'.$name] = $name;
    } else if ($dropdown->type == 'Color 3') {
        $color3[$name] = $name;
        $Anodized['Anodized|'.$name] = $name;
    } else if ($dropdown->type == 'Color 4') {
        $color4[$name] = $name;
        $colours['']['Special Colour|'.$name] = $name;
    } else if ($dropdown->type == 'Door Configuration') {
        $conf[$name] = ['text' => $name, 'code' => $dropdown->rule_code];
    }
}

if ($StandardColor)
    $colours['Standard Color'] = $StandardColor;

if ($Anodized)
    $colours['Anodized'] = $Anodized;

if ($CustomColour)
    $colours['Custom Colour'] = $CustomColour;

if ($PremiumColour)
    $colours['Premium Colour'] = $PremiumColour;

if ($SpecialColour)
    $colours['Special Colour'] = $SpecialColour;


foreach ($parts as $part) {
    $id = $part->id;
    $title = $part->title;
    $price = $part->users_parts[0]->price_per_unit;
    $code = $part->part_code;

    if ($part->users_parts[0]->show_in_additional_section_dropdown) {
        $additional_per_meter[] = ['text' => $title, 'value' => $title, 'data-price' => $price, 'data-code' => $code];
    }
    if ($part->users_parts[0]->show_in_additional_section_by_length_dropdown) {
        $additional_per_length[] = ['text' => $title, 'value' => $title, 'data-price' => $price, 'data-code' => $code];
    }
    if ($part->users_parts[0]->show_in_accessories_dropdown) {
        $accessories[] = ['text' => $title, 'value' => $title, 'data-price' => $price, 'data-code' => $code];
    }
    if ($part->users_parts[0]->master_calculator_value) {
        $mc_parts[$id] = ['title' => $title, 'price' => $price, 'data-code' => $code];
    }
}


?>


<h1>
    <small><?= __('Edit Order') ?></small>
</h1>


<?= $this->Form->create($quote, ['class' => 'form-horizontal add-quote-form', 'enctype' => 'multipart/form-data']) ?>

<?= $this->Form->hidden('role', ['id' => 'role']); ?>
<?= $this->Form->hidden('mfrole', ['id' => 'mf-role']) ?>


<?php if ($authUser['role'] == 'manufacturer') {
    echo '<p class="no-margin"><span>Manufacturer </span> <span style="color: red; font-weight: bold;">(as ' . ucfirst($quote->mfrole) . ')</span>:</p>';
} else {
    $fullName = $authUser['firstname'] . ' ' . $authUser['lastname'];
    echo '<p class="no-margin"><span>' . ucfirst($authUser['role']) . ': </span> <span style="font-weight: bold;"> ' . $fullName . ' </span></p>';
}

?>

<p class="no-margin">Customer Name: <span><b><?= h($quote->customer_name) ?></b></span></p>
<p class="no-margin">Quote ID: <span><b><?= h($quote->qId) ?></b></span></p>
<p>Status: <span>
        <?php if ($authUser['role'] == 'manufacturer'): ?>
            <?= $this->Form->select(
                'status',
                ['pending' => 'Pending', 'in progress' => 'In Progress',
                    'complete' => 'Complete', 'paid' => 'Paid', 'expired' => 'Expired'],
                ['class' => 'status-dropdown', 'data-style' => 'btn-primary', 'label' => true, 'value' => $quote->status]
            );
            ?>
        <?php else: ?>
            <span class="text-capitalize"><b><?= h($quote->status) ?></b></span>
        <?php endif; ?>
    </span>
</p>


<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                    Customer/Warranty Information
                </a>
            </h4>
        </div>
        <div id="collapseOne-2" class="panel-collapse collapse">
            <div class="panel-body">

                <fieldset>

                    <?= $this->element('Quotes/customer_information', []); ?>

                </fieldset>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                    POWDERCOATING
                </a>
            </h4>
        </div>
        <div id="collapseTwo-2" class="panel-collapse collapse">
            <div class="panel-body">


                <fieldset>

                    <?= $this->element('Quotes/pwd_coating', [
                        'standards' => $standards,
                        'color1' => $color1,
                        'color2' => $color2,
                        'color3' => $color3,
                        'color4' => $color4,
                    ]); ?>

                </fieldset>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                    ORDER DETAILS
                </a>
            </h4>
        </div>
        <div id="collapseThree-2" class="panel-collapse collapse">
            <div class="panel-body">

                <fieldset>


                    <div class="col-xs-12 table-responsive text-center">

                        <table class="table-bordered product-table products">
                            <tr>
                                <th>NO.</th>
                                <th>QTY</th>
                                <th>PRODUCT TYPE</th>
                                <th>INFILL</th>
                                <th>COLOUR</th>
                                <th>WINDOW or DOOR</th>
                                <th>9 or 11mm</th>
                                <th>CONFIGURATION</th>
                                <th>LOCATION / NOTES</th>
                                <th>HEIGHT MM</th>
                                <th>WIDTH MM</th>
                                <th>LOCKS</th>
                                <th>LOCK TYPE</th>
                                <th colspan="2">LOCK HANDLE HEIGHT</th>
                            </tr>


                            <?php if (count($quote['products']) > 0): ?>
                                <?php $i = 0;
                                foreach ($quote['products'] as $product): ?>

                                    <?= $this->element('Quotes/product_row', ['i' => $i, 'conf' => $conf, 'selected' => $product->product_configuration, 'colours' => $colours]); ?>

                                    <?php $i++; endforeach; ?>

                            <?php else: ?>

                                <?= $this->element('Quotes/product_row', ['i' => 0, 'conf' => $conf, 'colours' => $colours]); ?>

                            <?php endif; ?>

                        </table>


                        <div class="product-btns">


                            <button id="add-product-btn" type="button" class="btn btn-primary waves-effect btn-sm">Add
                                next
                                item
                            </button>
                            <button id="copy-product-btn" type="button" class="btn btn-primary waves-effect btn-sm">Copy
                                above
                                line
                            </button>
                        </div>
                    </div>

                </fieldset>

<!--                <hr>-->
<!---->
<!--                <fieldset>-->
<!---->
<!--                    <div class="col-xs-12 table-responsive text-center">-->
<!--                        <table class="table-bordered midrail-table products">-->
<!--                            <tr>-->
<!--                                <th colspan="10"-->
<!--                                    style="padding: 5px; font-size: 14px; background-color: rgb(216, 244, 255);">-->
<!--                                    Midrails-->
<!--                                </th>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <th>NO.</th>-->
<!--                                <th>QTY</th>-->
<!--                                <th>316/SS</th>-->
<!--                                <th>WINDOW</th>-->
<!--                                <th>Type</th>-->
<!--                                <th>HEIGHT MM</th>-->
<!--                                <th colspan="2">WIDTH MM</th>-->
<!---->
<!--                            </tr>-->

<!---->
<!--                        </table>-->
<!---->
<!--                        <button id="add-midrail-btn" type="button" class="btn btn-primary waves-effect btn-sm">Next-->
<!--                            Midrail-->
<!--                        </button>-->
<!--                    </div>-->
<!---->
<!--                </fieldset>-->
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseFour-2" class="collapsed" aria-expanded="false">
                    ADDITIONAL SECTIONS/ACCESSORIES
                </a>
            </h4>
        </div>
        <div id="collapseFour-2" class="panel-collapse collapse">
            <div class="panel-body">

                <fieldset>
                    <div class="col-lg-4 col-lg-4_5_1 table-responsive text-center">
                        <table class="table-bordered products additional-m-table">
                            <tr>
                                <th>ITEM NO.</th>
                                <th>PER METER</th>
                                <th>ADDITIONAL SECTION</th>
                                <th class="width-40">COST</th>
                                <th class="width-40">MARK UP %</th>
                                <th colspan="2">SELL PRICE</th>
                            </tr>

                            <?php if (count($quote['additionalpermeters']) > 5): ?>

                                <?php $i = 0;
                                foreach ($quote['additionalpermeters'] as $additionalpermeter): ?>

                                    <?= $this->element('Quotes/additional_m_row',
                                        ['i' => $i, 'additional_per_meter' => $additional_per_meter]); ?>

                                    <?php $i++; endforeach; ?>

                            <?php else: ?>
                                <?php for ($i = 0; $i < 5; $i++): ?>

                                    <?= $this->element('Quotes/additional_m_row',
                                        ['i' => $i, 'additional_per_meter' => $additional_per_meter]); ?>

                                <?php endfor; ?>

                            <?php endif; ?>


                        </table>
                        <button type="button" id="add-row-additional-m" class="btn btn-primary waves-effect btn-sm">Add
                            next
                            item
                        </button>
                    </div>

                    <div class="col-lg-4 col-lg-4_5_1 table-responsive text-center">
                        <table class="table-bordered additional-l-table products">
                            <tr>
                                <th>ITEM NO.</th>
                                <th>PER LENGTH</th>
                                <th>ADDITIONAL SECTION</th>
                                <th class="width-40">COST</th>
                                <th class="width-40">MARK UP %</th>
                                <th colspan="2">SELL PRICE</th>
                            </tr>

                            <?php for ($i = 0; $i < 5; $i++): ?>

                                <?= $this->element('Quotes/additional_l_row',
                                    ['i' => $i, 'additional_per_length' => $additional_per_length]); ?>

                            <?php endfor; ?>


                        </table>
                        <button type="button" id="add-row-additional-l" class="btn btn-primary waves-effect btn-sm">Add
                            next item
                        </button>
                    </div>
                    
                    <div class="col-lg-4 col-lg-4_5_2 table-responsive">
                        <table class="table-bordered products accessories-table">
                            <tr>
                                <th>ITEM NO.</th>
                                <th>EACH</th>
                                <th>ACCESSORIES</th>
                                <!--<th class="width-50">PRICE</th>-->
                                <th class="width-40">COST</th>
                                <th class="width-40">MARK UP %</th>
                                <th colspan="2">SELL PRICE</th>
                            </tr>

                            <?php for ($i = 0; $i < 3; $i++): ?>

                                <?= $this->element('Quotes/accessory_row',
                                    ['i' => $i, 'accessories' => $accessories]); ?>

                            <?php endfor; ?>


                        </table>
                    </div>
                    
                </fieldset>


                <div class="form-group"></div>


                <fieldset>
                    <div class="col-lg-6 table-responsive text-center">

                        <table class="table-bordered cutsheets-table">

                            <tr>
                                <th class="text-center" colspan="6"><strong>Additional Sections Cut Sheet</strong></th>
                            </tr>
                            <tr>
                                <th class="width-60 text-center">Qty</th>
                                <th class="width-200 text-center">Section</th>
                                <th class="width-100 text-center">Colour</th>
                                <th class="width-80 text-center">Cut size mm</th>
                                <th class="text-center">Notes</th>
                                <th class="width-10 text-center"></th>
                            </tr>

                            <?php if (count($quote['cutsheets']) > 3): ?>

                                <?php $i = 0;
                                foreach ($quote['cutsheets'] as $cutsheet): ?>

                                    <?= $this->element('Quotes/cutsheet_row',
                                        ['i' => $i, 'additional_per_meter' => $additional_per_meter, 'colours' => $colours]); ?>

                                    <?php $i++; endforeach; ?>

                            <?php else: ?>
                                <?php for ($i = 0; $i < 3; $i++): ?>

                                    <?= $this->element('Quotes/cutsheet_row',
                                        ['i' => $i, 'additional_per_meter' => $additional_per_meter, 'colours' => $colours]); ?>

                                <?php endfor; ?>

                            <?php endif; ?>

                        </table>
                        <button type="button" id="add-row-cutsheet" class="btn btn-primary waves-effect btn-sm">Add
                            next item
                        </button>
                        <button id="copy-cutsheet-btn" type="button" class="btn btn-primary waves-effect btn-sm">Copy
                                above line
                        </button>
                    </div>

                    <div class="col-lg-6 table-responsive text-center">
                        <table class="table-bordered customitem-table products">
                            <tr>
                                <th>QTY</th>
                                <th colspan="2">ADD CUSTOM ITEM <br>
                                    TO BE INVOICED BY THE MANUFACTURER - TICK BOX
                                </th>
                                <th>COST</th>
                                <th>MARK UP %</th>
                                <th colspan="2">CHARGED OUT AT</th>
                            </tr>


                            <?php if (count($quote['customitems']) > 3): ?>

                                <?php $i = 0;
                                foreach ($quote['customitems'] as $customitem): ?>

                                    <?= $this->element('Quotes/custom_item_row',
                                        ['i' => $i]); ?>

                                    <?php $i++; endforeach; ?>

                            <?php else: ?>
                                <?php for ($i = 0; $i < 3; $i++): ?>

                                    <?= $this->element('Quotes/custom_item_row',
                                        ['i' => $i]); ?>

                                <?php endfor; ?>

                            <?php endif; ?>


                        </table>
                        <button type="button" id="add-row-customitem" class="btn btn-primary waves-effect btn-sm">Add
                            next item
                        </button>
                    </div>
                </fieldset>

                
                <hr>
                <fieldset>
                    <div class="col-lg-8 table-responsive text-center" style="float:right;">                      
                        <?= $this->element('Quotes/notes'); ?>                      
                    </div>
                </fieldset>


            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseFive-2" class="collapsed" aria-expanded="false">
                    TOTAL COST / INSTALLATION
                </a>
            </h4>
        </div>
        <div id="collapseFive-2" class="panel-collapse collapse">
            <div class="panel-body">

                <fieldset class="col-xs-12">
                    <?= $this->element('Quotes/total_cost_tables'); ?>
                    <div class="panel panel-default panel-border col-md-5">
                        <?php echo $this->element('Quotes/installation', ['installationType' => $quote->installation_type]); ?>
                    </div>
                </fieldset>


            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseSeven-2" class="collapsed" aria-expanded="false">
                    Pricing Table
                </a>
            </h4>
        </div>
        <div id="collapseSeven-2" class="panel-collapse collapse">
            <div class="panel-body">

                <fieldset class="col-xs-12">

                    <?= $this->element('Quotes/mc_tables'); ?>

                </fieldset>


            </div>
        </div>
    </div>

    <div class="panel panel-default" <?php if ($authUser['role'] != 'manufacturer') {
        echo 'style="display: none;"';
    } ?>>
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapseSix-2" aria-expanded="false" class="collapsed">
                    Master Calculator Values
                </a>
            </h4>
        </div>
        <div id="collapseSix-2" class="panel-collapse collapse" aria-expanded="false">
            <div class="panel-body">
                <?= $this->element('Quotes/mc_values', ['mcvalues' => $mcvalues, 'mc_parts' => $mc_parts, 'installation' => $installation]); ?>
            </div>
        </div>
    </div>
</div> <!-- .panel-group -->

<input id="editpage" type="hidden" value="editpage">

<input type="hidden" name="products_to_delete">
<input type="hidden" name="midrails_to_delete">
<input type="hidden" name="additional_m_to_delete">
<input type="hidden" name="customitems_to_delete">
<input type="hidden" name="cutsheets_to_delete">

<input type="hidden" id="is-ordered" name="is_ordered">
<input type="hidden" id="is-copied" name="is_copied">
<input type="hidden" id="sendtoinstaller" name="sendtoinstaller">


<div class="form-inline date-inputs">
    <?php 
    if ( !in_array($quote->status, array('in progress', 'complete') )): ?>
        <?= $this->Form->Button('Save Changes', ['class' => 'btn btn-primary waves-effect save-quote-btn btn-sm', 'type' => 'button']) ?>
    <?php endif; ?>
    
    <?= $this->Form->Button('Save as a new Quote', ['class' => 'btn btn-primary waves-effect new-quote-btn btn-sm', 'type' => 'button']) ?>

    <span></span>


    <span>Order Date:
        <?php if(isset($quote->created)): ?>
            <input type="text" class="form-control input-sm" disabled="disabled"
                   value="<?= h($quote->created->format('d/m/Y')); ?>">
        <?php else: ?>
            <input type="text" class="form-control input-sm" disabled="disabled">
       <?php endif; ?>
    </span>

    <span>Required Date:
        <?= $this->Form->input('required_date',
            ['templates' => ['inputContainer' => '{{content}}'], 'type' => 'text',
                'class' => 'form-control input-sm', 'id' => 'datepicker-autoclose', 'label' => false]) ?>
    </span>
    
    <span>
        <?php if ($quote->status == 'pending'): ?>

        <?= $this->Form->Button('Save Changes and Convert to Order', ['class' => 'btn btn-primary waves-effect convert-to-order-btn btn-sm', 'type' => 'button']) ?>

    <?php endif; ?>
    </span>

</div>


<?= $this->Form->end() ?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="uploadForm" action="" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send file to manufacturer</h4>
                </div>
                <div class="modal-body">
                    <p>File: <input type="file" name="file" class="m-t-10" style="display:inline;"></p>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-6">
                        <span id="loading"> Sending...</span>
                        <span id="message"></span>
                    </div>
                    <div class="col-xs-6">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" value="Send Now" id="uploadimagebtn">
                        <input type="hidden" id="hdn_quote_id" value="<?php echo ($quote->id)?$quote->id:'';?>">
                    </div>
                </div>                
            </div>
        </form>        
    </div>
</div>

<?= $this->Html->script('add-quote.js', ['block' => 'script']); ?>
