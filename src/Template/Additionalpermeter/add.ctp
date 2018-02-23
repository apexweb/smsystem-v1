<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Additionalpermeter'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="additionalpermeter form large-9 medium-8 columns content">
    <?= $this->Form->create($additionalpermeter) ?>
    <fieldset>
        <legend><?= __('Add Additionalpermeter') ?></legend>
        <?php
            echo $this->Form->input('additional_item_number');
            echo $this->Form->input('additional_name');
            echo $this->Form->input('additional_per_meter');
            echo $this->Form->input('additional_price');
            echo $this->Form->input('quote_id', ['options' => $quotes, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
