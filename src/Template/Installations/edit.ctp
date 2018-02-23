<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $installation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $installation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Installations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="installations form large-9 medium-8 columns content">
    <?= $this->Form->create($installation) ?>
    <fieldset>
        <legend><?= __('Edit Installation') ?></legend>
        <?php
            echo $this->Form->input('door_amount');
            echo $this->Form->input('window_amount');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
