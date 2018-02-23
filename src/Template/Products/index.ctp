<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products index large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_sec_dig_perf_fibr') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_316_ss_gal_pet') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_window_or_door') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_emergency_window') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_window_frame_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_configuration') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_location_in_building') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_width') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_number_of_locks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_lock_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_lock_handle_height') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quote_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>
                <td><?= h($product->product_item_number) ?></td>
                <td><?= $this->Number->format($product->product_qty) ?></td>
                <td><?= h($product->product_sec_dig_perf_fibr) ?></td>
                <td><?= h($product->product_316_ss_gal_pet) ?></td>
                <td><?= h($product->product_window_or_door) ?></td>
                <td><?= h($product->product_emergency_window) ?></td>
                <td><?= h($product->product_window_frame_type) ?></td>
                <td><?= h($product->product_configuration) ?></td>
                <td><?= h($product->product_location_in_building) ?></td>
                <td><?= $this->Number->format($product->product_width) ?></td>
                <td><?= $this->Number->format($product->product_height) ?></td>
                <td><?= h($product->product_number_of_locks) ?></td>
                <td><?= h($product->product_lock_type) ?></td>
                <td><?= h($product->product_lock_handle_height) ?></td>
                <td><?= $product->has('quote') ? $this->Html->link($product->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $product->quote->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
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
