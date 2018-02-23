<?php
/*
 *  MF Quotes Page
 */
?>

<h1>
    <small>My Quotes</small>
</h1>

<div class="card-box font-13">


    <?= $this->element('Quotes/search_form', ['search' => $search, 'status' => $status, 'limited' => 'all']); ?>

    <table class="table table-bordered quotes-table small-padding font-500 table-responsive">
        <tr>
            <th>ORDER ID</th>
            <th>CUSTOMER NAME</th>
            <th>QUOTE DATE</th>
            <th>ORDER DATE</th>
            <th>REQUIRED DATE</th>
            <th>INSTALLATION & WARRANTY ADDRESS</th>
            <th class="width-150">PRINTOUTS</th>
            <th>ROLE</th>
            <th class="width-100"></th>
            <th>STATUS</th>
            <th>DELETE</th>
        </tr>

        <?php foreach ($quotes as $quote): ?>

            <tr class="quote-<?= str_replace(" ", "-", h($quote->status)); ?>">
                <td class="text-center font-15">
                    <?php echo h($quote->qId); ?>
                    <?php if ($quote->original_id > 0): ?>
                        <p class="font-11 no-margin">
                            <?= $this->Html->link(
                                $quote->original_qid,
                                ['controller' => 'Quotes', 'action' => 'edit', $quote->original_id],
                                ['class' => 'primary',]
                            ); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($quote->quoted): ?>
                        <?= $this->Form->postLink('<i class="md-lens"></i>',
                            ['action' => 'setquoted', $quote->id, 'myquotes'],
                            ['class' => 'icons', 'escape' => false]) ?>
                    <?php else: ?>
                        <?= $this->Form->postLink('<i class="md-panorama-fisheye"></i>',
                            ['action' => 'setquoted', $quote->id, 'myquotes'],
                            ['class' => 'icons', 'escape' => false]) ?>
                    <?php endif; ?>

                </td>
                <td>
                    <?= $this->Html->link(
                        ($quote->customer_name)?$quote->customer_name:'Update',
                        ['controller' => 'Quotes', 'action' => 'edit', $quote->id],
                        ['class' => 'primary',]
                    ); ?>                    
                </td>
                <td><?= h($quote->created->format('d/m/Y')) ?></td>
                <td>
                    <?php if ($quote->orderin_date != null) {
                        echo h($quote->orderin_date);
                    }; ?>
                </td>
                <td>
                    <?php if ($quote->required_date != null) {
                        echo h($quote->required_date);
                    }; ?>
                </td>
                <td><?= h($quote->warrantyAddress); ?></td>

                <td class="font-12"> <!-- Prinouts -->
                    <p class="no-margin">
                        <strong>
                            <?= $this->Html->link(
                                'Quote',
                                ['controller' => 'Quotes', 'action' => 'printout', $quote->id],
                                ['class' => 'primary',]
                            ); ?>
                        </strong>
                    </p>
                    <p class="no-margin">
                        <strong>
                            <?= $this->Html->link(
                                'Check Measure',
                                ['controller' => 'Quotes', 'action' => 'installsheet', $quote->id],
                                ['class' => 'primary',]
                            ); ?>
                        </strong>
                    </p>
                    <?php if ($quote->status != 'pending' && $quote->status != 'expired'): ?>
                        <p class="no-margin">
                            <strong>
                                <?= $this->Html->link(
                                    'Cutting Schedule',
                                    ['controller' => 'Quotes', 'action' => 'cuttingschedule', $quote->id],
                                    ['class' => 'primary',]
                                ); ?>
                            </strong>
                        </p>
                    <?php endif; ?>
                </td>

                <td class="text-capitalize" style="color: red;"><strong><?= h($quote->mfrole) ?></strong></td>
                <td class="font-12">
                    <?php if ($quote->status != 'pending' && $quote->status != 'expired'): ?>
                        <p class="no-margin">
                            <strong>
                                <?= $this->Html->link(
                                    'Service Fee',
                                    ['controller' => 'Quotes', 'action' => 'funnelweb', $quote->id],
                                    ['class' => 'primary',]
                                ); ?>
                            </strong>
                        </p>
                    <?php endif; ?>
                </td>
                <td class="text-capitalize" style="position: relative;">
                    <p class="no-margin"><?= h($quote->status) ?></p>

                    <?php if ($quote->status != 'complete' && $quote->status != 'paid'): ?>

                        <?php if ($quote->printed): ?>
                            <?= $this->Form->postLink('<i class="md-lens"></i>',
                                ['action' => 'setprinted', $quote->id, 'myquotes'],
                                ['class' => 'icons icon-abs', 'escape' => false]) ?>
                        <?php else: ?>
                            <?= $this->Form->postLink('<i class="md-panorama-fisheye"></i>',
                                ['action' => 'setprinted', $quote->id, 'myquotes'],
                                ['class' => 'icons icon-abs', 'escape' => false]) ?>
                        <?php endif; ?>


                        <p>
                            <?= $this->Form->postLink('Mark as Complete', ['action' => 'markascomplete', $quote->id, 'myquotes'],
                                ['confirm' => 'Are you sure?']); ?>
                        </p>
                    <?php endif; ?>
                </td>

                <td>
                    <span class="redlink">
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $quote->id, 'myquotes'], ['confirm' => 'Are you sure?']) ?>
                    </span>
                </td>
            </tr>

        <?php endforeach; ?>


    </table>


</div>


<?= $this->Html->script('quote-index.js', ['block' => 'script']); ?>