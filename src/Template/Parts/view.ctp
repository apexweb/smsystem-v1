<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Part'), ['action' => 'edit', $part->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Part'), ['action' => 'delete', $part->id], ['confirm' => __('Are you sure you want to delete # {0}?', $part->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Parts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Part'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="parts view large-9 medium-8 columns content">
    <h3><?= h($part->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($part->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= h($part->supplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= h($part->unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($part->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Buy Price Include GST') ?></th>
            <td><?= $this->Number->format($part->buy_price_include_GST) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= $this->Number->format($part->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marked Up') ?></th>
            <td><?= $this->Number->format($part->marked_up) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mark Up') ?></th>
            <td><?= $this->Number->format($part->mark_up) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Per Unit') ?></th>
            <td><?= $this->Number->format($part->price_per_unit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Master Calculator Value') ?></th>
            <td><?= $this->Number->format($part->master_calculator_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Display Order') ?></th>
            <td><?= $this->Number->format($part->display_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($part->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($part->modified) ?></td>
        </tr>
    </table>
</div>
