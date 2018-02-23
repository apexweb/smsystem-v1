<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Part'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersParts index large-9 medium-8 columns content">
    <h3><?= __('Users Parts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('supplier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('buy_price_include_GST') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mark_up') ?></th>
                <th scope="col"><?= $this->Paginator->sort('marked_up') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_per_unit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('part_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersParts as $usersPart): ?>
            <tr>
                <td><?= $this->Number->format($usersPart->id) ?></td>
                <td><?= h($usersPart->supplier) ?></td>
                <td><?= $this->Number->format($usersPart->buy_price_include_GST) ?></td>
                <td><?= h($usersPart->unit) ?></td>
                <td><?= $this->Number->format($usersPart->size) ?></td>
                <td><?= $this->Number->format($usersPart->mark_up) ?></td>
                <td><?= $this->Number->format($usersPart->marked_up) ?></td>
                <td><?= $this->Number->format($usersPart->price_per_unit) ?></td>
                <td><?= $usersPart->has('user') ? $this->Html->link($usersPart->user->username, ['controller' => 'Users', 'action' => 'view', $usersPart->user->id]) : '' ?></td>
                <td><?= $usersPart->has('part') ? $this->Html->link($usersPart->part->title, ['controller' => 'Parts', 'action' => 'view', $usersPart->part->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersPart->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersPart->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersPart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersPart->id)]) ?>
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
