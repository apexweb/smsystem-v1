<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Accessory'), ['action' => 'edit', $accessory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Accessory'), ['action' => 'delete', $accessory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accessories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Accessory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accessories view large-9 medium-8 columns content">
    <h3><?= h($accessory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Accessory Item Number') ?></th>
            <td><?= h($accessory->accessory_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accessory Name') ?></th>
            <td><?= h($accessory->accessory_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accessory Price') ?></th>
            <td><?= h($accessory->accessory_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $accessory->has('quote') ? $this->Html->link($accessory->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $accessory->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($accessory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accessory Each') ?></th>
            <td><?= $this->Number->format($accessory->accessory_each) ?></td>
        </tr>
    </table>
</div>
