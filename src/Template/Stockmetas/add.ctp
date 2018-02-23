<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stockmetas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stocks'), ['controller' => 'Stocks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stock'), ['controller' => 'Stocks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stockmetas form large-9 medium-8 columns content">
    <?= $this->Form->create($stockmeta) ?>
    <fieldset>
        <legend><?= __('Add Stockmeta') ?></legend>
        <?php
            echo $this->Form->input('metakey');
            echo $this->Form->input('metavalue');
            echo $this->Form->input('stock_id', ['options' => $stocks]);
            echo $this->Form->input('quote_id', ['options' => $quotes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
