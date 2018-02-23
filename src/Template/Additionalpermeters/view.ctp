<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Additionalpermeter'), ['action' => 'edit', $additionalpermeter->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Additionalpermeter'), ['action' => 'delete', $additionalpermeter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $additionalpermeter->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Additionalpermeters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Additionalpermeter'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="additionalpermeters view large-9 medium-8 columns content">
    <h3><?= h($additionalpermeter->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Additional Item Number') ?></th>
            <td><?= h($additionalpermeter->additional_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Name') ?></th>
            <td><?= h($additionalpermeter->additional_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Price') ?></th>
            <td><?= h($additionalpermeter->additional_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $additionalpermeter->has('quote') ? $this->Html->link($additionalpermeter->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $additionalpermeter->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($additionalpermeter->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Per Meter') ?></th>
            <td><?= $this->Number->format($additionalpermeter->additional_per_meter) ?></td>
        </tr>
    </table>
</div>
