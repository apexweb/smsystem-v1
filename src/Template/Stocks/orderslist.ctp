<h1>
    <small>Add Orders to Combined Stock</small>
</h1>

<div class="card-box font-13">
    <table class="table table-bordered table-responsive">
        <tr>
            <th class="text-center">ORDER ID</th>
            <th>CUSTOMER NAME</th>
            <th>ORDER DATE</th>
            <th>REQUIRED DATE</th>
            <th class="width-250">ADD MATERIALS TO COMBINED STOCK</th>
            <th>STATUS</th>
            <th>STOCK</th>
        </tr>


        <?php foreach ($quotes as $quote): ?>

            <tr class="quote-<?= str_replace(" ", "-", h($quote->status)); ?>">
                <td class="text-center"><strong><?= h($quote->qId); ?></strong></td>
                <td><?= h($quote->customer_name); ?></td>
                <td><?= h($quote->orderin_date); ?></td>
                <td><?= h($quote->required_date); ?></td>
                <td>
                    <strong>
                        <?php if (isset($quote->stockmetas[0]->stock_id) && $quote->stockmetas[0]->stock_id > 0): ?>
                            <?= $this->Html->link(
                                'Cutting Schedule',
                                ['controller' => 'Quotes', 'action' => 'cuttingschedule', $quote->id],
                                ['class' => 'primary',]
                            ); ?>
                        <?php else: ?>
                            <?= $this->Html->link(
                                'Cutting Schedule',
                                ['controller' => 'Stocks', 'action' => 'cuttingschedule', $quote->id],
                                ['class' => 'primary',]
                            ); ?>
                        <?php endif; ?>
                    </strong>
                </td>
                <td class="text-capitalize"><?= h($quote->status); ?></td>
                <td>
                    <?php if (isset($quote->stockmetas[0]->stock_id) && $quote->stockmetas[0]->stock_id > 0): ?>
                        <span>Already Added to Combined Stock List #<?= $quote->stockmetas[0]['stock_id']; ?></span>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

</div>