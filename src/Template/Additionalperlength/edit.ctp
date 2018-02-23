<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $additionalperlength->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $additionalperlength->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Additionalperlength'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="additionalperlength form large-9 medium-8 columns content">
    <?= $this->Form->create($additionalperlength) ?>
    <fieldset>
        <legend><?= __('Edit Additionalperlength') ?></legend>
        <?php
            echo $this->Form->input('additional_item_number');
            echo $this->Form->input('additional_name');
            echo $this->Form->input('additional_per_length');
            echo $this->Form->input('additional_price');
            echo $this->Form->input('quote_id', ['options' => $quotes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
