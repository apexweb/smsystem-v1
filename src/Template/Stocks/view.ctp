<?php

$adms = [];
$adls = [];
$accs = [];
$customitems = [];
$stockmetas = [];
$allStocks = [];

if ($stock->status == 'inactive') {
    $stock->stockmetas = null;
} else {

    function fillArr($arr, $key, $value)
    {
        if (isset($arr[$key])) {
            $arr[$key] = $arr[$key] + $value;
        } else {
            if ($value > 0) {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    foreach ($orders as $order) {
        $quote = $order[0]->quote;
        foreach ($quote->additionalpermeters as $additionalpermeter) {
            $adms = fillArr($adms, $additionalpermeter->additional_name, $additionalpermeter->additional_per_meter);
        }

        foreach ($quote->additionalperlength as $additionalperlength) {
            $adls = fillArr($adls, $additionalperlength->additional_name, $additionalperlength->additional_per_length);
        }

        foreach ($quote->accessories as $accessory) {
            $accs = fillArr($accs, $accessory->accessory_name, $accessory->accessory_each);
        }

        foreach ($quote->customitems as $customitem) {
            if ($customitem->custom_tick) {
                $customitems = fillArr($customitems, $customitem->custom_description, $customitem->custom_qty);
            }
        }

        foreach ($order as $stockmeta) {
            $stockmetas = fillArr($stockmetas, $stockmeta->metakey, 1);
        }
        $allStocks[$quote->standard_color] = $stockmetas;
        $stockmetas = [];
    }

}



//
//foreach ($stock->stockmetas as $stockmeta) {
//    $stockmetas = fillArr($stockmetas, $stockmeta->metakey, 1);
//}
?>

<h1>
    <small>Combined Stock (#<?= h($stock->id) ?>)</small>
</h1>

<div class="card-box">
    <h4 class="top-padding">Included Orders</h4 class="top-padding">
    <div class="row">
        <div class="col-sm-4">
            <table class="table table-bordered">
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td style="color: #00aced">
                            <strong>
                                <?= $this->Html->link(
                                    h($order[0]->quote->qId),
                                    ['controller' => 'Quotes', 'action' => 'cuttingschedule', $order[0]->quote['id']],
                                    ['class' => 'primary', 'style' => 'color: #00aced !important;"']
                                ); ?>
                            </strong>
                        </td>
                        <td>
                            <?= $this->Form->postLink('Delete', ['action' => 'deletefromstock', $stock->id, $order[0]->quote['id']],
                                ['confirm' => 'Are you sure?', 'class' => 'red']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <h4 class="top-padding">Frames & Components</h4 class="top-padding">
            <?php foreach ($allStocks as $color => $stockmeta): ?>
            <table class="table table-bordered">
                <th class="grey" colspan="2"><?= h($color); ?></th>
                <?php foreach ($stockmeta as $key => $value): ?>
                    <tr>
                        <th class="width-250"><?= h($key) ?></th>
                        <td><?= h($value) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php endforeach; ?>



            <h4 class="top-padding">Additional Per Meter</h4 class="top-padding">
            <table class="table table-bordered">
                <?php foreach ($adms as $key => $value): ?>
                    <tr>
                        <th class="width-250"><?= $key; ?></th>
                        <td><?= $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>


            <h4 class="top-padding">Additional Per Length</h4 class="top-padding">
            <table class="table table-bordered">
                <?php foreach ($adls as $key => $value): ?>
                    <tr>
                        <th class="width-250"><?= $key; ?></th>
                        <td><?= $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>


            <h4 class="top-padding">Accessories</h4 class="top-padding">
            <table class="table table-bordered">
                <?php foreach ($accs as $key => $value): ?>
                    <tr>
                        <th class="width-250"><?= $key; ?></th>
                        <td><?= $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>


            <h4 class="top-padding">Custom Items</h4 class="top-padding">
            <table class="table table-bordered">
                <?php foreach ($customitems as $key => $value): ?>
                    <tr>
                        <th class="width-250"><?= $key; ?></th>
                        <td><?= $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div> <!-- .row -->
</div>