
<h2>
    <small><?= $table->name; ?></small>
</h2>
<div class="card-box">

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


</div>
