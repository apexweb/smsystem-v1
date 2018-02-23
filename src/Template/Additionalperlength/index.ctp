<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Additionalperlength'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="additionalperlength index large-9 medium-8 columns content">
    <h3><?= __('Additionalperlength') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_per_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($additionalperlength as $additionalperlength): ?>
            <tr>
                <td><?= $this->Number->format($additionalperlength->id) ?></td>
                <td><?= h($additionalperlength->additional_item_number) ?></td>
                <td><?= h($additionalperlength->additional_name) ?></td>
                <td><?= $this->Number->format($additionalperlength->additional_per_length) ?></td>
                <td><?= h($additionalperlength->additional_price) ?></td>
                <td><?= $additionalperlength->has('quote') ? $this->Html->link($additionalperlength->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $additionalperlength->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $additionalperlength->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $additionalperlength->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $additionalperlength->id], ['confirm' => __('Are you sure you want to delete # {0}?', $additionalperlength->id)]) ?>
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
