<!-- File: src/Template/Parts/index.ctp -->

<?php

// PAGE: Manufacturer's Parts

/************* NOTE ***************
 *
 * $part belongs to the model: $user_parts
 * $part->part belongs to the model: $part
 *
 *
 **/

?>


<div class="card-box font-13">
    <h1><?php
        switch ($filterby) {
            case 'mc':
                echo 'Master Calculator Parts';
                break;
            case 'permeters':
                echo 'Section per Meter Parts';
                break;
            case 'perlengths':
                echo 'Section per Length Parts';
                break;
            case 'accesories':
                echo 'Accesories';
                break;
            default:
                echo 'All Parts';
                break;
        }

        ?>
    </h1>
    <?php if ($authUser['role'] == 'supplier'): ?>
        <div class="col-md-7" style="margin-bottom: 15px;">
            <?= $this->Html->link('Add Part', ['action' => 'add'], ['class' => 'btn btn-default'],
                ['escape' => false]) ?>
        </div>
    <?php else: ?>
        <div class="col-md-7"></div>
    <?php endif; ?>

    <!-- <div class="col-md-2 col-md-offset-8 col-sm-offset-0">-->
    <div class="col-md-5 search-form col-sm-offset-0" style="margin-bottom: 15px;text-align:right;">
        <?= $this->Form->create($this, ['type' => 'get', 'class' => 'form-inline search-form']) ?>
        
        <div class="input-group">
            <span class="input-group-btn">
                <?= $this->Form->Button('<i class="fa fa-search"></i>', ['class' => 'btn waves-effect waves-light btn-primary btn-sm']) ?>
            </span>
            <?= $this->Form->input('search', ['class' => 'form-control input-sm', 'placeholder' => 'Find', 'label' => false,
                'value' => $search]) ?>
        </div>
        <div class="input-group">
            <?= $this->Form->select(
                'filterby',
                ['' => 'All', 'mc' => 'Master Cal', 'permeters' => 'Section per Meter',
                    'perlengths' => 'Sections per Length', 'accesories' => 'Accesories',],
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'label' => true,
                    'value' => $filterby]
            );

            ?>
        </div>
        <?php if ($mf): ?>
            <?= $this->Form->hidden('mf', ['value' => $mf]); ?>
        <?php endif; ?>

        <?= $this->Form->end(); ?>
    </div>
    <table id="datatable" class="table table-striped table-bordered table-hover small-padding all-parts table-responsive">
        <thead>
        <tr>

            <th>Title</th>
            <th>Code</th>
            <th>Part No.</th>
            <th>Supplier</th>
            <th>Buy price include GST</th>
            <th>Unit</th>
            <th>Size</th>
            <th>Marked up Price</th>
            <th>Mark up %</th>
            <th>Price per unit</th>
            <th>Per M</th>
            <th>Per Ln</th>
            <th>Acc</th>
            <th>MC</th>
            <th>Created Date</th>
            <th colspan="2">Edit / Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($parts as $part): ?>
            <tr>
                <td><?= $part->part->title ?></td>
                <td><?= $part->part->part_code ?></td>
                <td><?= $part->part->part_number ?></td>
                <td><?= $part->part->supplier ?></td>
                <td><?= $part->buy_price_include_GST ?></td>
                <td><?= $part->part->unit ?></td>
                <td><?= $part->part->size ?></td>
                <td><?= $part->marked_up ?></td>
                <td><?= $part->mark_up ?></td>
                <td><?= $part->price_per_unit ?></td>
                <td>
                    <?php if ($part->show_in_additional_section_dropdown): ?>
                        <div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
                            <input type="checkbox" disabled="disabled" checked="checked">
                            <label></label>
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($part->show_in_additional_section_by_length_dropdown): ?>
                        <div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
                            <input type="checkbox" disabled="disabled" checked="checked">
                            <label></label>
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($part->show_in_accessories_dropdown): ?>
                        <div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
                            <input type="checkbox" disabled="disabled" checked="checked">
                            <label></label>
                        </div>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($part->master_calculator_value): ?>
                        <div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
                            <input type="checkbox" disabled="disabled" checked="checked">
                            <label></label>
                        </div>
                    <?php endif; ?>
                </td>

                <td><?= $part->part->created->format('d/m/Y'); ?></td>

                <td>
                    <?= $this->Html->link('Edit', ['action' => 'edit', $part->id]) ?>
                    <span> / </span>
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $part->id], ['confirm' => 'Are you sure?']) ?>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->Html->script('quote-index.js', ['block' => 'script']); ?>