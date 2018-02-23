<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dropdown'), ['action' => 'edit', $dropdown->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dropdown'), ['action' => 'delete', $dropdown->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dropdown->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dropdowns'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dropdown'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dropdowns view large-9 medium-8 columns content">
    <h3><?= h($dropdown->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($dropdown->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($dropdown->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dropdown->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manual Sort') ?></th>
            <td><?= $this->Number->format($dropdown->manual_sort) ?></td>
        </tr>
    </table>
</div>
