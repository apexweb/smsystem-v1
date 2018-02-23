<div class="card-box">
    <p>You are currently logged in as Manufacturer. You are still able to create quotes as different roles.
    </p>
    <br>

    <?= $this->Form->create(null, ['class' => 'form-inline']); ?>

    <?= $this->Form->input(
        'role',
        [
            'type' => 'select',
            'options' => $options,
            'empty' => false,
            'label' => 'Please select the role you want to create the quote with: ',
            'class' => 'form-control',
            'style' => 'margin-left: 20px',
        ]
    ); ?>
    <br>
    <?= $this->Form->Button('PROCEED', ['class' => 'btn btn-primary waves-effect',]) ?>

    <?= $this->Form->end(); ?>
</div>