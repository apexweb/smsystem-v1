<?php

/*
 * Dist, Re, Whsl Quotes List Page
 */

?>


    <h1>
        <small>Quotes List</small>
    </h1>

    <div class="card-box font-13">


        <?= $this->element('Quotes/search_form', ['search' => $search, 'status' => $status, 'limited' => 'index']); ?>

        <table class="table table-bordered quotes-table small-padding font-500 table-responsive">
            <tr>
                <th>ORDER ID</th>
                <th>CUSTOMER NAME</th>
                <th>QUOTE DATE</th>
                <th>ORDER DATE</th>
                <th>REQUIRED DATE</th>
                <th>INSTALLATION & WARRANTY ADDRESS</th>
                <th class="width-175">PRINTOUTS</th>
                <th></th>
                <th>STATUS</th>
                <th>DELETE</th>
            </tr>

            <?php foreach ($quotes as $quote): ?>

                <tr class="quote-<?= str_replace(" ", "-", h($quote->status)); ?>">
                    <td class="text-center font-15">
                        <?= h($quote->qId) ?>
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
                                ['action' => 'setquoted', $quote->id, 'index'],
                                ['class' => 'icons', 'escape' => false]) ?>
                        <?php else: ?>
                            <?= $this->Form->postLink('<i class="md-panorama-fisheye"></i>',
                                ['action' => 'setquoted', $quote->id, 'index'],
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
                    </td>
                    <td class="text-capitalize" style="position: relative;">
                        <p class="no-margin"><?= h($quote->status) ?></p>

                        <?php if ($quote->status == 'pending'): ?>
                            <?= $this->Form->postLink('Mark as Expired', ['action' => 'markasexpired', $quote->id, 'index'], ['confirm' => 'Are you sure?']) ?>
                        <?php endif; ?>

                    </td>

                    <td>
                    <span class="redlink">
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $quote->id, 'index'], ['confirm' => 'Are you sure?']) ?>
                    </span>
                    </td>
                </tr>

            <?php endforeach; ?>


        </table>


    </div>


<?= $this->Html->script('quote-index.js', ['block' => 'script']); ?>