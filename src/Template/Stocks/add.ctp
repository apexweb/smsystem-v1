<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stocks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stockmetas'), ['controller' => 'Stockmetas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Stockmeta'), ['controller' => 'Stockmetas', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stocks form large-9 medium-8 columns content">
    <?= $this->Form->create($stock) ?>
    <fieldset>
        <legend><?= __('Add Stock') ?></legend>
        <?php
            echo $this->Form->input('mf_id');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
