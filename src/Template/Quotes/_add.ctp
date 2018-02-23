<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Quotes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="quotes form large-9 medium-8 columns content">
    <?= $this->Form->create($quote) ?>
    <fieldset>
        <legend><?= __('Add Quote') ?></legend>
        <?php
            echo $this->Form->input('original_id');
            echo $this->Form->input('order_date');
            echo $this->Form->input('required_date');
            echo $this->Form->input('orderin_date');
            echo $this->Form->input('notes');
            echo $this->Form->input('notes2');
            echo $this->Form->input('notes3');
            echo $this->Form->input('customer_name');
            echo $this->Form->input('mobile');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
            echo $this->Form->input('fax');
            echo $this->Form->input('street');
            echo $this->Form->input('suburb');
            echo $this->Form->input('postcode');
            echo $this->Form->input('standard');
            echo $this->Form->input('second_color_required');
            echo $this->Form->input('color1');
            echo $this->Form->input('color2');
            echo $this->Form->input('color3');
            echo $this->Form->input('color4');
            echo $this->Form->input('standard_color');
            echo $this->Form->input('color1_color');
            echo $this->Form->input('color2_color');
            echo $this->Form->input('color3_color');
            echo $this->Form->input('color4_color');
            echo $this->Form->input('installation_required');
            echo $this->Form->input('additional_installation_amount');
            echo $this->Form->input('status');
            echo $this->Form->input('count_additional');
            echo $this->Form->input('freight_cost');
            echo $this->Form->input('notes4');
            echo $this->Form->input('window_door_suite_manufacturer');
            echo $this->Form->input('quoted');
            echo $this->Form->input('printed');
            echo $this->Form->input('send_file_to_manufacturer');
            echo $this->Form->input('mf_role');
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>



                            <?php if (count($quote['midrails']) > 0): ?>
                                <?php $i = 0;
                                foreach ($quote['midrails'] as $midrail): ?>

                                    <?= $this->element('Quotes/midrail_row', ['i' => $i]); ?>

                                    <?php $i++;
                                endforeach; ?>

                            <?php else: ?>

                                <?= $this->element('Quotes/midrail_row', ['i' => 0]); ?>

                            <?php endif; ?>