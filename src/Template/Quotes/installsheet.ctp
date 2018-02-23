
<div class="row">

    <div class="col-sm-11">
        <h1>
            <small>Check Measure/Install Sheet</small>
        </h1>
    </div>

    <div class="col-sm-1 text-right-not-xs">

        <?=
        $this->Html->link($this->Html->image('/assets/images/pdficon.png', ['alt' => 'PDF']),
            ['controller' => 'Quotes', 'action' => 'installsheetpdf', $quote->id . '.pdf'],
            ['class' => 'pdflink', 'escape' => false]);
        ?>
    </div>

</div>

<div class="card-box font-13">
    <table class="table table-responsive">
        <tr>
            <th class="width-150">Created By:</th>
            <td><?= h($quote->user->username) ?></td>
            <th class="width-150">Cust. Order No.</th>
            <td><?= h($quote->qId) ?></td>
            <td></td>
            <th colspan="3"><?= h($quote->created->format('d/m/Y')) ?></th>
        </tr>
        <tr>
            <th class="width-150">Name:</th>
            <td><?= h($quote->customer_name) ?></td>
            <th>Home Phone:</th>
            <td><?= h($quote->phone) ?></td>
            <th class="width-150">Ph. No.</th>
            <td><?= h($quote->mobile) ?></td>
            <th class="width-150">E-mail Address:</th>
            <td><?= h($quote->email) ?></td>
        </tr>
        <tr>
            <th class="width-150">Street:</th>
            <td colspan="7"><?= h($quote->street . ' ' . $quote->suburb) ?></td>
        </tr>
        <tr>
            <th class="width-150">
                Date Required:
            </th>
            <td>
                <?php if ($quote->required_date != null) {
                    echo h($quote->required_date);
                }; ?>
            </td>
            <th class="text-center">Colour -</th>
            <td colspan="5" class="colors-td">
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
        </tr>
    </table>
</div>

<div class="card-box">
    <table class="table table-responsive table-bordered quote-installsheet small-padding">
        <tr>
            <th class="width-50">ITEM</th>
            <th>PANEL QTY</th>
            <th>LOCATION</th>
            <th colspan="2">CONFIGURATION</th>
            <th>WIN OR DR</th>
            <th>COLOUR</th>
            <th>FRAME</th>
            <th>HEIGHT</th>
            <th></th>
            <th>WIDTH</th>
            <th></th>
            <th>HANDLE HEIGHT</th>
            <!--            <th>NOTE</th>-->
        </tr>

        <?php foreach ($quote['products'] as $product): ?>
            <?php if ($product->product_qty > 0): ?>
                <tr>
                    <td><?= h($product->product_item_number) ?></td>
                    <td class="width-75"><?= h($product->product_qty) ?></td>
                    <td><?= h($product->product_location_in_building) ?></td>

                    <td><?= h($product->product_configuration) ?></td>
                    <td class="width-100">
                        <?php
                        echo h($product->product_sec_dig_perf_fibr);
                        ?>
                    </td>

                    <td class="width-50"><?= h($product->product_window_or_door) ?></td>
                    <td ><?= h($product->colour) ?></td>
                    <td><?= h($product->product_window_frame_type) ?></td>
                    
                    <td class="width-75"><?= h($product->product_height) ?></td>
                    <td></td>
                    <td class="width-75"><?= h($product->product_width) ?></td>
                    <td></td>
                    <td class="width-75"><?= h($product->product_lock_handle_height) ?></td>
                    <!--                <td></td>-->
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>


    </table>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default panel-border">
            <div class="panel-body">
                <table class="table table-bordered quote-installsheet small-padding">
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
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default panel-border">
            <div class="panel-body">
                <table class="table table-bordered quote-installsheet small-padding">
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
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-default panel-border">
            <div class="panel-body">
                <table class="table table-bordered quote-installsheet small-padding">
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
            </div>
        </div>
    </div>


    <div class="col-md-4 col-md-offset-4 col-sm-offset-0">
        <div class="panel panel-default panel-border">
            <div class="panel-body">
                <table class="table table-bordered quote-installsheet small-padding">
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
            </div>
        </div>
    </div>
</div> <!-- .row -->


<div class="card-box installsheet-notes">

    <div>
        <p><strong>Notes</strong></p>
        <hr class="small-margin">
        <p><?= h($quote->notes) ?></p>
    </div>

    <div>
        <p><strong>Notes to the Installer</strong></p>
        <hr class="small-margin">
        <p><?= h($quote->notes_installer) ?></p>
    </div>


    <?php if ($quote->installation_cost_include_on_check_measure): ?>
        <div>
            <p><strong>Installation Total</strong></p>
            <hr class="small-margin">
            <p><?= h($quote->installation_total_cost) ?></p>
        </div>
    <?php endif; ?>
</div>
