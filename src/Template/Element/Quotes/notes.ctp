<?php $this->Form->templates([
    'nestingLabel' => '{{input}}<label{{attrs}}>{{text}}</label>',
    'formGroup' => '{{input}}{{label}}',
]); ?>
<div class="col-lg-12 form-inline text-right-lg">
    <div class="form-group">
        <?= $this->Form->textarea('notes_customer',
            ['class' => 'form-control notes-textarea', 'label' => false, 'placeholder' => 'Notes to Customer']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->textarea('notes_installer',
            ['class' => 'form-control notes-textarea', 'label' => false, 'placeholder' => 'Notes to Installer']) ?>
    </div>
    <div class="form-group">
        <?= $this->Form->textarea('notes_manufacturer',
            ['class' => 'form-control notes-textarea', 'label' => false, 'placeholder' => 'Notes to Manufacturer']) ?>
    </div>
</div>
<?php if($quote->id){?>
    <div class="col-lg-12 form-inline text-right-lg">
        <div class="form-group">
            <a href="" class="send-mf" data-toggle="modal" data-target="#myModal">Send File to Manufacturer</a>
        </div>    
    </div>
<?php }?>