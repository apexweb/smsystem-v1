<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Midrail'), ['action' => 'edit', $midrail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Midrail'), ['action' => 'delete', $midrail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $midrail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Midrails'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Midrail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="midrails view large-9 medium-8 columns content">
    <h3><?= h($midrail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Midrail Item Number') ?></th>
            <td><?= h($midrail->midrail_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail Sec Dig Perf Fibr') ?></th>
            <td><?= h($midrail->midrail_sec_dig_perf_fibr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail 316 Ssgal Pet') ?></th>
            <td><?= h($midrail->midrail_316_ssgal_pet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail Window Or Door') ?></th>
            <td><?= h($midrail->midrail_window_or_door) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail Window Frame Type') ?></th>
            <td><?= h($midrail->midrail_window_frame_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrails Configuration') ?></th>
            <td><?= h($midrail->midrails_configuration) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $midrail->has('quote') ? $this->Html->link($midrail->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $midrail->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($midrail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail Qty') ?></th>
            <td><?= $this->Number->format($midrail->midrail_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail Height') ?></th>
            <td><?= $this->Number->format($midrail->midrail_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midrail Width') ?></th>
            <td><?= $this->Number->format($midrail->midrail_width) ?></td>
        </tr>
    </table>
</div>
