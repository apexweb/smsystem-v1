<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Additionalpermeter'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="additionalpermeters index large-9 medium-8 columns content">
    <h3><?= __('Additionalpermeters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_per_meter') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($additionalpermeters as $additionalpermeter): ?>
            <tr>
                <td><?= $this->Number->format($additionalpermeter->id) ?></td>
                <td><?= h($additionalpermeter->additional_item_number) ?></td>
                <td><?= h($additionalpermeter->additional_name) ?></td>
                <td><?= $this->Number->format($additionalpermeter->additional_per_meter) ?></td>
                <td><?= h($additionalpermeter->additional_price) ?></td>
                <td><?= $additionalpermeter->has('quote') ? $this->Html->link($additionalpermeter->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $additionalpermeter->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $additionalpermeter->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $additionalpermeter->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $additionalpermeter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $additionalpermeter->id)]) ?>
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
