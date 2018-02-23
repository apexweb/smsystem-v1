<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Matrixtables'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Prices'), ['controller' => 'Prices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Price'), ['controller' => 'Prices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="matrixtables form large-9 medium-8 columns content">
    <?= $this->Form->create($matrixtable) ?>
    <fieldset>
        <legend><?= __('Add Matrixtable') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('widths');
            echo $this->Form->input('heights');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
