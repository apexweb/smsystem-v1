<div class="row">

    <div class="col-sm-11">
        <h1>
            <small>Cutting Schedule</small>
        </h1>
    </div>

    <div class="col-sm-1 text-right-not-xs">

        <?=
        $this->Html->link($this->Html->image('/assets/images/pdficon.png', ['alt' => 'PDF']),
            ['controller' => 'Quotes', 'action' => 'cuttingspdf', $quote->id . '.pdf'],
            ['class' => 'pdflink', 'escape' => false]);
        ?>
    </div>

</div>

<?= $this->element('Quotes/cutting_schedule', ['quote' => $quote]); ?>









