


<div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-offset-0 col-sm-12">
        <h1>
            <small>Orders Scheduler</small>
        </h1>
        <div id="calendar" class="fc fc-unthemed fc-ltr">
            <table class="fc-header"></table>
        </div>
    </div>

</div> <!-- .row -->


<p style="display: none" id="json-result">
    <?= json_encode(compact('quotes')); ?>
</p>


<?= $this->Html->css('/assets/fullcalendar/fullcalendar.min.css', ['block' => 'css']) ?>
<?= $this->Html->script('/assets/plugins/moment/min/moment.min.js', ['block' => 'script']) ?>
<?= $this->Html->script('/assets/fullcalendar/fullcalendar.min.js', ['block' => 'script']) ?>
<?= $this->Html->script('scheduler.js', ['block' => 'script']) ?>
