<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            echo $this->Form->input('product_item_number');
            echo $this->Form->input('product_qty');
            echo $this->Form->input('product_sec_dig_perf_fibr');
            echo $this->Form->input('product_316_ss_gal_pet');
            echo $this->Form->input('product_window_or_door');
            echo $this->Form->input('product_emergency_window');
            echo $this->Form->input('product_window_frame_type');
            echo $this->Form->input('product_configuration');
            echo $this->Form->input('product_location_in_building');
            echo $this->Form->input('product_width');
            echo $this->Form->input('product_height');
            echo $this->Form->input('product_number_of_locks');
            echo $this->Form->input('product_lock_type');
            echo $this->Form->input('product_lock_handle_height');
            echo $this->Form->input('quote_id', ['options' => $quotes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
