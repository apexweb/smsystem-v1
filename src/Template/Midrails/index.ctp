<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Midrail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="midrails index large-9 medium-8 columns content">
    <h3><?= __('Midrails') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_sec_dig_perf_fibr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_316_ssgal_pet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_window_or_door') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrail_window_frame_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midrails_configuration') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($midrails as $midrail): ?>
            <tr>
                <td><?= $this->Number->format($midrail->id) ?></td>
                <td><?= h($midrail->midrail_item_number) ?></td>
                <td><?= $this->Number->format($midrail->midrail_qty) ?></td>
                <td><?= h($midrail->midrail_sec_dig_perf_fibr) ?></td>
                <td><?= h($midrail->midrail_316_ssgal_pet) ?></td>
                <td><?= h($midrail->midrail_window_or_door) ?></td>
                <td><?= $this->Number->format($midrail->midrail_height) ?></td>
                <td><?= $this->Number->format($midrail->midrail_width) ?></td>
                <td><?= h($midrail->midrail_window_frame_type) ?></td>
                <td><?= h($midrail->midrails_configuration) ?></td>
                <td><?= $midrail->has('quote') ? $this->Html->link($midrail->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $midrail->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $midrail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $midrail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $midrail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $midrail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
