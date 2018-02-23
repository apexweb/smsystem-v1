<?php
$allMfs = [];
foreach ($mfs as $mf) {
    $allMfs[$mf->id] = $mf->username;
}

?>


<div class="card-box">

    <?= $this->Form->create(null, ['class' => 'form-inline', 'type' => 'get', 'url' => ['action' => 'index']]); ?>

    <?= $this->Form->input(
        'mf',
        [
            'type' => 'select',
            'options' => $allMfs,
            'empty' => false,
            'label' => 'Please select the user you want to view or edit his parts: ',
            'class' => 'form-control',
            'style' => 'margin-left: 20px',
        ]
    ); ?>

    <br>
    <?= $this->Form->Button('PROCEED', ['class' => 'btn btn-primary waves-effect',]) ?>

    <?= $this->Form->end(); ?>
</div>