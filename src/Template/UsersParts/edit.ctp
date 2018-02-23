<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersPart->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersPart->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users Parts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersParts form large-9 medium-8 columns content">
    <?= $this->Form->create($usersPart) ?>
    <fieldset>
        <legend><?= __('Edit Users Part') ?></legend>
        <?php
            echo $this->Form->input('supplier');
            echo $this->Form->input('buy_price_include_GST');
            echo $this->Form->input('unit');
            echo $this->Form->input('size');
            echo $this->Form->input('mark_up');
            echo $this->Form->input('marked_up');
            echo $this->Form->input('price_per_unit');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('part_id', ['options' => $parts]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
