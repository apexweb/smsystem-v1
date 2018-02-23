<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cutsheet'), ['action' => 'edit', $cutsheet->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cutsheet'), ['action' => 'delete', $cutsheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cutsheet->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cutsheets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cutsheet'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cutsheets view large-9 medium-8 columns content">
    <h3><?= h($cutsheet->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Section') ?></th>
            <td><?= h($cutsheet->section) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Colour') ?></th>
            <td><?= h($cutsheet->colour) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notes') ?></th>
            <td><?= h($cutsheet->notes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $cutsheet->has('quote') ? $this->Html->link($cutsheet->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $cutsheet->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cutsheet->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cut To Size') ?></th>
            <td><?= $this->Number->format($cutsheet->cut_to_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qty') ?></th>
            <td><?= $this->Number->format($cutsheet->qty) ?></td>
        </tr>
    </table>
</div>
