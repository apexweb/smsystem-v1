<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cutsheet'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cutsheets index large-9 medium-8 columns content">
    <h3><?= __('Cutsheets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('section') ?></th>
                <th scope="col"><?= $this->Paginator->sort('colour') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cut_to_size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('notes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cutsheets as $cutsheet): ?>
            <tr>
                <td><?= $this->Number->format($cutsheet->id) ?></td>
                <td><?= h($cutsheet->section) ?></td>
                <td><?= h($cutsheet->colour) ?></td>
                <td><?= $this->Number->format($cutsheet->cut_to_size) ?></td>
                <td><?= $this->Number->format($cutsheet->qty) ?></td>
                <td><?= h($cutsheet->notes) ?></td>
                <td><?= $cutsheet->has('quote') ? $this->Html->link($cutsheet->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $cutsheet->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cutsheet->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cutsheet->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cutsheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cutsheet->id)]) ?>
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
