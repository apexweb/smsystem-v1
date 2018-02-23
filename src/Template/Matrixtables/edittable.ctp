<h2>
    <small><?= $table->name; ?></small>
</h2>




<div class="card-box">
    <div class="csv-upload-wrapper">
        <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'uploadcsv']]); ?>

        <?= $this->Form->hidden('tableId', ['value' => $table->id]); ?>


        <input type="file" name="file">
        <?= $this->Form->Button('Upload csv', ['class' => 'btn btn-primary waves-effect update-values-btn btn-sm', 'type' => 'submit']) ?>


        <?= $this->Form->end() ?>
    </div>


    <?php foreach ($table->prices as $price): ?>

        <input class="measures" type="hidden" value="<?= htmlspecialchars($price->pricePerMesure); ?>"
               parent-table-id="<?= $price->table_id; ?>">

    <?php endforeach; ?>

    <input class="widths" type='hidden' value="<?= htmlspecialchars($table->widths); ?>">
    <input class="heights" type="hidden" value="<?= htmlspecialchars($table->heights); ?>">
    <input class="inc-midrail" type="hidden" value="<?= htmlspecialchars($table->midrail_requirement); ?>">


    <div class="card-box font-12">

        <table id="table" class="table matrix-table table-bordered small-padding">

        </table>

    </div>

    <?= $this->Form->create(null); ?>

    <?= $this->Form->hidden('tableId', ['value' => $table->id]); ?>

    <input type="hidden" name="data" id="data">

    <?= $this->Form->Button('Update values', ['class' => 'btn btn-primary waves-effect update-values-btn btn-sm', 'type' => 'button']) ?>

    <?= $this->Form->end() ?>
</div>

<?= $this->Html->script('matrix.js', ['block' => 'script']); ?>
