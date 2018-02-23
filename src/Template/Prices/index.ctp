<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Price'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Matrixtables'), ['controller' => 'Matrixtables', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Matrixtable'), ['controller' => 'Matrixtables', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prices index large-9 medium-8 columns content">
    <h3><?= __('Prices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('matrixtable_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prices as $price): ?>
            <tr>
                <td><?= $this->Number->format($price->id) ?></td>
                <td><?= $price->has('matrixtable') ? $this->Html->link($price->matrixtable->name, ['controller' => 'Matrixtables', 'action' => 'view', $price->matrixtable->id]) : '' ?></td>
                <td><?= $price->has('user') ? $this->Html->link($price->user->username, ['controller' => 'Users', 'action' => 'view', $price->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $price->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $price->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $price->id], ['confirm' => __('Are you sure you want to delete # {0}?', $price->id)]) ?>
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
