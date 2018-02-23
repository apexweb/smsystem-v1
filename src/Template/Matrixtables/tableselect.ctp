<?php
$allTables = [];
foreach ($tables as $table) {
    $allTables[$table->id] = $table->name;
}

?>



<div class="card-box">

    <?= $this->Form->create(null, ['class' => 'form-inline', 'type' => 'get', 'url' => ['action' => 'edittable']]); ?>


    <?= $this->Form->input(
        'id',
        [
            'type' => 'select',
            'options' => $allTables,
            'empty' => false,
            'label' => 'Please select the matrix table you want to edit: ',
            'class' => 'form-control input-sm',
            'style' => 'margin-left: 20px',
        ]
    ); ?>

    <br>
    <?= $this->Form->Button('PROCEED', ['class' => 'btn btn-primary waves-effect',]) ?>

    <?= $this->Form->end(); ?>

</div>