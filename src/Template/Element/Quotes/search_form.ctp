<div class="row" style="margin-bottom: 15px;">
    <div class="col-md-7">

    </div>


    <div class="col-md-5 search-form">
        <?= $this->Form->create($this, ['type' => 'get', 'class' => 'form-inline search-form']) ?>

        <div class="input-group">
        <span class="input-group-btn">
            <?= $this->Form->Button('<i class="fa fa-search"></i>', ['class' => 'btn waves-effect waves-light btn-primary btn-sm']) ?>
        </span>
            <?= $this->Form->input('search', ['class' => 'form-control input-sm', 'placeholder' => 'Find', 'label' => false,
                'value' => $search]) ?>
        </div>

        <?php if ($limited == 'orders'): ?>
            <?= $this->Form->select(
                'status',
                ['' => 'All', 'in progress' => 'In Progress',
                    'complete' => 'Complete', 'paid' => 'Paid'],
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'label' => true, 'value' => $status]
            );
            ?>
        <?php elseif ($limited == 'index'): ?>
            <?= $this->Form->select(
                'status',
                ['' => 'All', 'pending' => 'Pending', 'in progress' => 'In Progress',
                    'complete' => 'Complete', 'expired' => 'Expired'],
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'label' => true, 'value' => $status]
            );
            ?>
        <?php else: ?>
            <?= $this->Form->select(
                'status',
                ['' => 'All', 'pending' => 'Pending', 'in progress' => 'In Progress',
                    'complete' => 'Complete', 'paid' => 'Paid', 'expired' => 'Expired'],
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'label' => true, 'value' => $status]
            );
            ?>
        <?php endif; ?>


        <?= $this->Form->end() ?>

    </div> <!-- .search-form -->
</div>