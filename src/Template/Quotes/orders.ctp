<?php

/*
 * Orders Page For MF (Displays All ORDERS)
 */

?>

    <h1>
        <small>Orders List</small>
    </h1>
    <div class="card-box font-13">


        <?= $this->element('Quotes/search_form', ['search' => $search, 'status' => $status, 'limited' => 'orders']); ?>


        <table class="table quotes-table table-bordered small-padding font-500 table-responsive">
            <tr>
                <th>CREATED BY</th>
                <th>CUSTOMER NAME</th>
                <th>ORDER DATE</th>
                <th>REQUIRED DATE</th>
                <th>INSTALLATION & WARRANTY ADDRESS</th>
                <th>PRINTOUTS</th>
                <th class="width-175"></th>
                <th>STATUS</th>
                <th>DELETE</th>
            </tr>

            <?php foreach ($quotes as $quote): ?>

                <tr class="quote-<?= str_replace(" ", "-", h($quote->status)); ?>">
                    <td class="text-center">
                        <p class="no-margin"><?= $quote->user->username; ?></p>
                        <p class="no-margin"><?= $quote->qId; ?></p>
                    </td>

                    <td><?= h($quote->customer_name) ?></td>

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

                    <td class="font-12">
                        <p class="no-margin">

                            <strong>
                                <?= $this->Html->link(
                                    'Cutting Schedule',
                                    ['controller' => 'Quotes', 'action' => 'cuttingschedule', $quote->id],
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
                    </td>

                    <td class="font-12">
                        <p class="no-margin">
                            <strong>
                                <?= $this->Html->link(
                                    'Invoice Amount',
                                    ['controller' => 'Quotes', 'action' => 'invoice', $quote->id],
                                    ['class' => 'primary',]
                                ); ?>
                            </strong>
                        </p>
                        <p class="no-margin">
                            <strong>
                                <?= $this->Html->link(
                                    'Service Fee',
                                    ['controller' => 'Quotes', 'action' => 'funnelweb', $quote->id],
                                    ['class' => 'primary',]
                                ); ?>
                            </strong>
                        </p>
                    </td>

                    <td class="text-capitalize" style="position:relative;">

                        <p class="no-margin"><?= h($quote->status) ?></p>

                        <?php if ($quote->status == 'in progress'): ?>
                            <?php if ($quote->printed): ?>
                                <?= $this->Form->postLink('<i class="md-lens"></i>',
                                    ['action' => 'setprinted', $quote->id, 'orders'],
                                    ['class' => 'icons icon-abs', 'escape' => false]) ?>
                            <?php else: ?>
                                <?= $this->Form->postLink('<i class="md-panorama-fisheye"></i>',
                                    ['action' => 'setprinted', $quote->id, 'orders'],
                                    ['class' => 'icons icon-abs', 'escape' => false]) ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <p>

                            <?php if ($quote->status != 'complete' && $quote->status != 'paid'): ?>
                                <?= $this->Form->postLink('Mark as Complete', ['action' => 'markascomplete', $quote->id, 'orders'], ['confirm' => 'Are you sure?']) ?>
                            <?php endif; ?>

                        </p>
                    </td>

                    <td class="text-center">
                        <span class="redlink">
                            <?= $this->Form->postLink('Delete', ['action' => 'delete', $quote->id, 'orders'], ['confirm' => 'Are you sure?']) ?>
                        </span>
                    </td>
                </tr>

            <?php endforeach; ?>


        </table>


    </div>


<?= $this->Html->script('quote-index.js', ['block' => 'script']); ?>