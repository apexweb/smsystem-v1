<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stockmeta'), ['action' => 'edit', $stockmeta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stockmeta'), ['action' => 'delete', $stockmeta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockmeta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stockmetas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stockmeta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stocks'), ['controller' => 'Stocks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock'), ['controller' => 'Stocks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockmetas view large-9 medium-8 columns content">
    <h3><?= h($stockmeta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Metakey') ?></th>
            <td><?= h($stockmeta->metakey) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Metavalue') ?></th>
            <td><?= h($stockmeta->metavalue) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock') ?></th>
            <td><?= $stockmeta->has('stock') ? $this->Html->link($stockmeta->stock->id, ['controller' => 'Stocks', 'action' => 'view', $stockmeta->stock->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $stockmeta->has('quote') ? $this->Html->link($stockmeta->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $stockmeta->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($stockmeta->id) ?></td>
        </tr>
    </table>
</div>
