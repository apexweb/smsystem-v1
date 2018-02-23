<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Customitem'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customitems index large-9 medium-8 columns content">
    <h3><?= __('Customitems') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('custom_qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('custom_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('custom_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('custom_markup') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customitems as $customitem): ?>
            <tr>
                <td><?= $this->Number->format($customitem->id) ?></td>
                <td><?= $this->Number->format($customitem->custom_qty) ?></td>
                <td><?= h($customitem->custom_description) ?></td>
                <td><?= h($customitem->custom_price) ?></td>
                <td><?= h($customitem->custom_markup) ?></td>
                <td><?= $customitem->has('quote') ? $this->Html->link($customitem->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $customitem->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customitem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customitem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customitem->id)]) ?>
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
