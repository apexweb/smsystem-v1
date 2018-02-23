<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customitem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customitem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Customitems'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customitems form large-9 medium-8 columns content">
    <?= $this->Form->create($customitem) ?>
    <fieldset>
        <legend><?= __('Edit Customitem') ?></legend>
        <?php
            echo $this->Form->input('custom_qty');
            echo $this->Form->input('custom_description');
            echo $this->Form->input('custom_price');
            echo $this->Form->input('custom_markup');
            echo $this->Form->input('quote_id', ['options' => $quotes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
