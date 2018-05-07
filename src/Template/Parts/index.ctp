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
	<?php if($role == 'supplier'){ ?>
		<?= $this->element('Parts/factory'); ?>
	<?php }?>
	<?php if($role == 'manufacturer'){ ?>
		<?= $this->element('Parts/index'); ?>
	<?php }?>
	

</div>

<?= $this->Html->script('quote-index.js', ['block' => 'script']); ?>