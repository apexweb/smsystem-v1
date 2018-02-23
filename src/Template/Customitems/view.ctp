<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customitem'), ['action' => 'edit', $customitem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customitem'), ['action' => 'delete', $customitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customitem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customitems'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customitem'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customitems view large-9 medium-8 columns content">
    <h3><?= h($customitem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Custom Description') ?></th>
            <td><?= h($customitem->custom_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Custom Price') ?></th>
            <td><?= h($customitem->custom_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Custom Markup') ?></th>
            <td><?= h($customitem->custom_markup) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $customitem->has('quote') ? $this->Html->link($customitem->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $customitem->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customitem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Custom Qty') ?></th>
            <td><?= $this->Number->format($customitem->custom_qty) ?></td>
        </tr>
    </table>
</div>
