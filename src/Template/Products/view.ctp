<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Item Number') ?></th>
            <td><?= h($product->product_item_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Sec Dig Perf Fibr') ?></th>
            <td><?= h($product->product_sec_dig_perf_fibr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product 316 Ss Gal Pet') ?></th>
            <td><?= h($product->product_316_ss_gal_pet) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Window Or Door') ?></th>
            <td><?= h($product->product_window_or_door) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Emergency Window') ?></th>
            <td><?= h($product->product_emergency_window) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Window Frame Type') ?></th>
            <td><?= h($product->product_window_frame_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Configuration') ?></th>
            <td><?= h($product->product_configuration) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Location In Building') ?></th>
            <td><?= h($product->product_location_in_building) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Number Of Locks') ?></th>
            <td><?= h($product->product_number_of_locks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Lock Type') ?></th>
            <td><?= h($product->product_lock_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Lock Handle Height') ?></th>
            <td><?= h($product->product_lock_handle_height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quote') ?></th>
            <td><?= $product->has('quote') ? $this->Html->link($product->quote->customer_name, ['controller' => 'Quotes', 'action' => 'view', $product->quote->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Qty') ?></th>
            <td><?= $this->Number->format($product->product_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Width') ?></th>
            <td><?= $this->Number->format($product->product_width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Height') ?></th>
            <td><?= $this->Number->format($product->product_height) ?></td>
        </tr>
    </table>
</div>
