<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Mcvalues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mcvalues form large-9 medium-8 columns content">
    <?= $this->Form->create($mcvalue) ?>
    <fieldset>
        <legend><?= __('Add Mcvalue') ?></legend>
        <?php
            echo $this->Form->input('secperf_dist');
            echo $this->Form->input('secperf_whsl');
            echo $this->Form->input('secperf_re');
            echo $this->Form->input('dgfibr_dist');
            echo $this->Form->input('dgfibr_whsl');
            echo $this->Form->input('dgfibr_re');
            echo $this->Form->input('std');
            echo $this->Form->input('spec1');
            echo $this->Form->input('spec2');
            echo $this->Form->input('spec3');
            echo $this->Form->input('spec4');
            echo $this->Form->input('hrly_sd');
            echo $this->Form->input('hrly_sw');
            echo $this->Form->input('hrly_dd');
            echo $this->Form->input('hrly_dw');
            echo $this->Form->input('hrly_fd');
            echo $this->Form->input('hrly_fw');
            echo $this->Form->input('hrly_pd');
            echo $this->Form->input('hrly_pw');
            echo $this->Form->input('cleanup_sd');
            echo $this->Form->input('cleanup_sw');
            echo $this->Form->input('cleanup_dd');
            echo $this->Form->input('cleanup_dw');
            echo $this->Form->input('cleanup_fd');
            echo $this->Form->input('cleanup_fw');
            echo $this->Form->input('cleanup_pd');
            echo $this->Form->input('cleanup_pw');
            echo $this->Form->input('markup_sd');
            echo $this->Form->input('markup_sw');
            echo $this->Form->input('markup_dd');
            echo $this->Form->input('markup_dw');
            echo $this->Form->input('markup_fd');
            echo $this->Form->input('markup_fw');
            echo $this->Form->input('markup_pd');
            echo $this->Form->input('markup_pw');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
