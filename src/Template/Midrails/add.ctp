<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Midrails'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="midrails form large-9 medium-8 columns content">
    <?= $this->Form->create($midrail) ?>
    <fieldset>
        <legend><?= __('Add Midrail') ?></legend>
        <?php
            echo $this->Form->input('midrail_item_number');
            echo $this->Form->input('midrail_qty');
            echo $this->Form->input('midrail_sec_dig_perf_fibr');
            echo $this->Form->input('midrail_316_ssgal_pet');
            echo $this->Form->input('midrail_window_or_door');
            echo $this->Form->input('midrail_height');
            echo $this->Form->input('midrail_width');
            echo $this->Form->input('midrail_window_frame_type');
            echo $this->Form->input('midrails_configuration');
            echo $this->Form->input('quote_id', ['options' => $quotes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
