<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Stockmeta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stocks'), ['controller' => 'Stocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock'), ['controller' => 'Stocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockmetas index large-9 medium-8 columns content">
    <h3><?= __('Stockmetas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('metakey') ?></th>
                <th scope="col"><?= $this->Paginator->sort('metavalue') ?></th>
                <th scope="col"><?= $this->Paginator->sort('stock_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stockmetas as $stockmeta): ?>
            <tr>
                <td><?= $this->Number->format($stockmeta->id) ?></td>
                <td><?= h($stockmeta->metakey) ?></td>
                <td><?= h($stockmeta->metavalue) ?></td>
                <td><?= $stockmeta->has('stock') ? $this->Html->link($stockmeta->stock->id, ['controller' => 'Stocks', 'action' => 'view', $stockmeta->stock->id]) : '' ?></td>
                <td><?= $stockmeta->has('quote') ? $this->Html->link($stockmeta->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $stockmeta->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $stockmeta->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stockmeta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockmeta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockmeta->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
