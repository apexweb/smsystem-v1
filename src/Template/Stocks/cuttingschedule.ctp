<?php

$all_stocks = [];

foreach ($stocks as $stock) {
    $all_stocks[] = ['text' => $stock->fullInfo, 'value' => $stock->id];
}


?>

<h1>
    <small>Stock Order</small>
</h1>


<?= $this->Form->create(null, ['url' => ['action' => 'addmaterials']]); ?>

<input type="hidden" name="quote_id" value="<?= $quote->id ?>">
<input type="hidden" name="new">

<div class="panel-group" id="accordion-test-2">
    <?php if ($all_stocks): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="true"
                       class="collapsed">
                        USE EXISTING COMBINED STOCK LIST
                    </a>
                </h4>
            </div>
            <div id="collapseOne-2" class="panel-collapse collapse in" aria-expanded="true">
                <div class="panel-body">

                    <?= $this->Form->select(
                        'stock',
                        $all_stocks,
                        ['empty' => false, 'label' => false, 'class' => 'form-control input-sm width-200', 'data-style' => 'btn-primary']
                    );
                    ?>

                    <br>
                    <?= $this->Form->Button('ADD MATERIALS',
                        ['class' => 'btn btn-primary waves-effect btn-sm width-200 add-to-exising-list', 'type' => 'button']) ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed"
                   aria-expanded="false">
                    CREATE NEW COMBINED STOCK LIST
                </a>
            </h4>
        </div>
        <div id="collapseTwo-2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">

                <?= $this->Form->Button('CREATE LIST & ADD MATERIALS',
                    ['class' => 'btn btn-primary waves-effect btn-sm width-200 add-new', 'type' => 'button']) ?>

            </div>
        </div>
    </div>
</div>


<?= $this->element('Quotes/cutting_schedule', ['quote' => $quote]); ?>


<?= $this->Form->end(); ?>

<?= $this->Html->script('stock-add-material.js', ['block' => 'script']); ?>
