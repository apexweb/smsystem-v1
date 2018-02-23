<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Part'), ['action' => 'edit', $usersPart->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Part'), ['action' => 'delete', $usersPart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersPart->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Parts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Part'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersParts view large-9 medium-8 columns content">
    <h3><?= h($usersPart->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= h($usersPart->supplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= h($usersPart->unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersPart->has('user') ? $this->Html->link($usersPart->user->username, ['controller' => 'Users', 'action' => 'view', $usersPart->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Part') ?></th>
            <td><?= $usersPart->has('part') ? $this->Html->link($usersPart->part->title, ['controller' => 'Parts', 'action' => 'view', $usersPart->part->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersPart->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Buy Price Include GST') ?></th>
            <td><?= $this->Number->format($usersPart->buy_price_include_GST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= $this->Number->format($usersPart->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mark Up') ?></th>
            <td><?= $this->Number->format($usersPart->mark_up) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marked Up') ?></th>
            <td><?= $this->Number->format($usersPart->marked_up) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Per Unit') ?></th>
            <td><?= $this->Number->format($usersPart->price_per_unit) ?></td>
        </tr>
    </table>
</div>
