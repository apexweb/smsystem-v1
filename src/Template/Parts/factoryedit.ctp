<div class="card-box">

    <h1>Edit Part</h1>
    <br>
    <?= $this->Form->create($part, ['class' => 'form-horizontal']); ?>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('title', ['class' => 'form-control input-sm', 'label' => 'Part Name']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('part_code', ['class' => 'form-control input-sm', 'label' => 'Code']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('part_number', ['class' => 'form-control input-sm', 'label' => 'Part No.']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('supplier', ['class' => 'form-control input-sm']) ?>
        </div>
    </div>


    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('buy_price_include_GST', ['class' => 'form-control input-sm buy-price', 'disabled' => 'disabled']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('unit', ['class' => 'form-control input-sm']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('size', ['class' => 'form-control input-sm size']) ?>
        </div>
    </div>


    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('mark_up', ['class' => 'form-control input-sm markup', 'disabled' => 'disabled', 'label' => 'Mark Up %']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('marked_up', ['class' => 'form-control input-sm marked-up', 'disabled' => 'disabled', 'label' => 'Marked Up Price']) ?>
        </div>
    </div>



    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('price_per_unit', ['class' => 'form-control input-sm price-per-unit', 'disabled' => 'disabled']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="checkbox checkbox-primary">
                <?= $this->Form->input('show_in_additional_section_dropdown',
                    ['type' => 'checkbox',
                        'disabled' => 'disabled',
                        'label' => 'Show In Additional Section Per Meter Dropdown',
                        'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>
            </div>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="checkbox checkbox-primary">
                <?= $this->Form->input('show_in_additional_section_by_length_dropdown',
                    ['type' => 'checkbox',
                        'disabled' => 'disabled',
                        'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>
            </div>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div class="checkbox checkbox-primary">
                <?= $this->Form->input('show_in_accessories_dropdown',
                    ['type' => 'checkbox',
                        'disabled' => 'disabled',
                        'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>
            </div>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">

            <div class="checkbox checkbox-primary">
                <?= $this->Form->input('master_calculator_value',
                    ['type' => 'checkbox',
                        'disabled' => 'disabled',
                        'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>
            </div>
        </div>
    </div>


    <div class="form-group text-center m-t-40">
        <div class=" col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-info btn-block text-uppercase waves-effect waves-light']) ?>

        </div>
    </div>

    <?= $this->Form->end() ?>

</div>

<?= $this->Html->script('add-part.js', ['block' => 'script']); ?>