<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Additionalperlength'), ['action' => 'edit', $additionalperlength->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Additionalperlength'), ['action' => 'delete', $additionalperlength->id], ['confirm' => __('Are you sure you want to delete # {0}?', $additionalperlength->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Additionalperlength'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Additionalperlength'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="additionalperlength view large-9 medium-8 columns content">
    <h3><?= h($additionalperlength->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Additional Item Number') ?></th>
            <td><?= h($additionalperlength->additional_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Name') ?></th>
            <td><?= h($additionalperlength->additional_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Price') ?></th>
            <td><?= h($additionalperlength->additional_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $additionalperlength->has('quote') ? $this->Html->link($additionalperlength->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $additionalperlength->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($additionalperlength->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Per Length') ?></th>
            <td><?= $this->Number->format($additionalperlength->additional_per_length) ?></td>
        </tr>
    </table>
</div>
