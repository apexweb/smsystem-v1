<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dropdown->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dropdown->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dropdowns'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dropdowns form large-9 medium-8 columns content">
    <?= $this->Form->create($dropdown) ?>
    <fieldset>
        <legend><?= __('Edit Dropdown') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('type');
            echo $this->Form->input('manual_sort');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
