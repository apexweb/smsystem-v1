<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Accessory'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accessories index large-9 medium-8 columns content">
    <h3><?= __('Accessories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accessory_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accessory_each') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accessory_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('accessory_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accessories as $accessory): ?>
            <tr>
                <td><?= $this->Number->format($accessory->id) ?></td>
                <td><?= h($accessory->accessory_item_number) ?></td>
                <td><?= $this->Number->format($accessory->accessory_each) ?></td>
                <td><?= h($accessory->accessory_name) ?></td>
                <td><?= h($accessory->accessory_price) ?></td>
                <td><?= $accessory->has('quote') ? $this->Html->link($accessory->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $accessory->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $accessory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessory->id)]) ?>
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
