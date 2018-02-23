<div class="col-xs-12 font-12">

    <?php foreach ($matrixTables as $table): ?>


        <?php if (isset($table->prices[0]->pricePerMesure)): ?>
            <input class="price-per-measures" data-name="<?= $table->name ?>" type="hidden"
                   value="<?= htmlspecialchars($table->prices[0]->pricePerMesure); ?>">
        <?php endif; ?>

        <input class="midrail-inc" data-table="<?= $table->name ?>" type="hidden"
               value="<?= htmlspecialchars($table->midrail_requirement); ?>">

        <table class="table matrix-table small-padding table-responsive" data-table="<?= $table->name ?>">
            <caption class="table-name-caption"><?= $table->name ?> Prices</caption>
        </table>


    <?php endforeach; ?>

</div>