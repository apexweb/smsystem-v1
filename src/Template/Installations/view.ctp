<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Installation'), ['action' => 'edit', $installation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Installation'), ['action' => 'delete', $installation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $installation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Installations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Installation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="installations view large-9 medium-8 columns content">
    <h3><?= h($installation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Door Amount') ?></th>
            <td><?= h($installation->door_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $installation->has('user') ? $this->Html->link($installation->user->username, ['controller' => 'Users', 'action' => 'view', $installation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($installation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Window Amount') ?></th>
            <td><?= $this->Number->format($installation->window_amount) ?></td>
        </tr>
    </table>
</div>
