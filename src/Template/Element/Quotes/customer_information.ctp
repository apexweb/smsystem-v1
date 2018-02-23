<div class="col-lg-3 col-md-4 col-xs-12 form-horizontal">


    <div class="form-group">


        <label class="control-label col-md-5">Created Date: </label>
        <div class="col-md-7">
            <?php if ($quote->created): ?>
                <input type="text" class="form-control input-sm" disabled="disabled"
                       value="<?= h($quote->created->format('d/m/Y')); ?>">
            <?php else: ?>
                <input type="text" class="form-control input-sm created-date" disabled="disabled"/>
            <?php endif; ?>
        </div>

    </div>

    <div class="form-group">
        <?= $this->Form->input('customer_name',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group"><h4><?= __('Installation & Warranty Address') ?></h4></div>


    <div class="form-group ">
        <?= $this->Form->input('street',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group ">
        <?= $this->Form->input('suburb',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group ">
        <?= $this->Form->input('postcode',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group ">
        <?= $this->Form->input('state',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>
</div>

<div class="col-lg-3 col-md-4 col-xs-12 col-lg-offset-1 col-md-offset-1 col-ms-offset-0">

    <div class="form-group"><h4><?= __('Contact Details') ?></h4></div>


    <div class="form-group ">
        <?= $this->Form->input('mobile',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group ">
        <?= $this->Form->input('phone',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group ">
        <?= $this->Form->input('email',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>

    <div class="form-group ">
        <?= $this->Form->input('fax',
            ['templates' => ['inputContainer' => '{{content}}',
                'formGroup' => '<div class="col-md-5 control-label">{{label}}:</div><div class="col-md-7">{{input}}</div>',
            ],
                'class' => 'form-control input-sm',
            ]);
        ?>
    </div>


</div>
<div class="col-lg-3 col-md-4 col-xs-12 col-lg-offset-1 col-md-offset-1 col-ms-offset-0">

    <div class="form-group ">
        <?= $this->Form->textarea('notes', ['class' => 'form-control input-sm', 'placeholder' => 'Notes']) ?>
    </div>

</div>
