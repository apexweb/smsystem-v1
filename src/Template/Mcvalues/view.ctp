<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mcvalue'), ['action' => 'edit', $mcvalue->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mcvalue'), ['action' => 'delete', $mcvalue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mcvalue->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Mcvalues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mcvalue'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mcvalues view large-9 medium-8 columns content">
    <h3><?= h($mcvalue->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Secperf Dist') ?></th>
            <td><?= h($mcvalue->secperf_dist) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Secperf Whsl') ?></th>
            <td><?= h($mcvalue->secperf_whsl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Secperf Re') ?></th>
            <td><?= h($mcvalue->secperf_re) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dgfibr Dist') ?></th>
            <td><?= h($mcvalue->dgfibr_dist) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dgfibr Whsl') ?></th>
            <td><?= h($mcvalue->dgfibr_whsl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dgfibr Re') ?></th>
            <td><?= h($mcvalue->dgfibr_re) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Std') ?></th>
            <td><?= h($mcvalue->std) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Spec1') ?></th>
            <td><?= h($mcvalue->spec1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Spec2') ?></th>
            <td><?= h($mcvalue->spec2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Spec3') ?></th>
            <td><?= h($mcvalue->spec3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Spec4') ?></th>
            <td><?= h($mcvalue->spec4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Sd') ?></th>
            <td><?= h($mcvalue->hrly_sd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Sw') ?></th>
            <td><?= h($mcvalue->hrly_sw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Dd') ?></th>
            <td><?= h($mcvalue->hrly_dd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Dw') ?></th>
            <td><?= h($mcvalue->hrly_dw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Fd') ?></th>
            <td><?= h($mcvalue->hrly_fd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Fw') ?></th>
            <td><?= h($mcvalue->hrly_fw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Pd') ?></th>
            <td><?= h($mcvalue->hrly_pd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hrly Pw') ?></th>
            <td><?= h($mcvalue->hrly_pw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Sd') ?></th>
            <td><?= h($mcvalue->cleanup_sd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Sw') ?></th>
            <td><?= h($mcvalue->cleanup_sw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Dd') ?></th>
            <td><?= h($mcvalue->cleanup_dd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Dw') ?></th>
            <td><?= h($mcvalue->cleanup_dw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Fd') ?></th>
            <td><?= h($mcvalue->cleanup_fd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Fw') ?></th>
            <td><?= h($mcvalue->cleanup_fw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Pd') ?></th>
            <td><?= h($mcvalue->cleanup_pd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cleanup Pw') ?></th>
            <td><?= h($mcvalue->cleanup_pw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Sd') ?></th>
            <td><?= h($mcvalue->markup_sd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Sw') ?></th>
            <td><?= h($mcvalue->markup_sw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Dd') ?></th>
            <td><?= h($mcvalue->markup_dd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Dw') ?></th>
            <td><?= h($mcvalue->markup_dw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Fd') ?></th>
            <td><?= h($mcvalue->markup_fd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Fw') ?></th>
            <td><?= h($mcvalue->markup_fw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Pd') ?></th>
            <td><?= h($mcvalue->markup_pd) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Markup Pw') ?></th>
            <td><?= h($mcvalue->markup_pw) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mcvalue->id) ?></td>
        </tr>
    </table>
</div>
