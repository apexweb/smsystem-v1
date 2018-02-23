<div class="card-box">

    <?= $this->Flash->render() ?>

    <h1>Drop Down values</h1>

    <hr>
    <div class="row">

        <?php $this->Form->templates([
            'nestingLabel' => '{{input}}<label{{attrs}}>{{text}}</label>',
            'formGroup' => '{{input}}{{label}}',
        ]); ?>

        <div class="col-xs-12">

            <div class="csv-upload-wrapper">
                <?= $this->Form->create(null, ['type' => 'file', 'url' => ['action' => 'uploadcsv']]); ?>
                <?php if($userIds) { ?>
                
                <div class="checkbox-primary m-l-15">
                    <h4> Select Manufacturers </h4>
                    <?php foreach($userIds as $mf){ ?>
                    <?= $this->Form->input("manufacturer[$mf->id]", ['type' => 'checkbox', 'label' => $mf->firstname .' '. $mf->lastname,'value' => $mf->id,
                                                'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']])
                                        ?>
                    <?php } ?>
                </div>
                <?= $this->Form->input("all-manufacturers", ['type' => 'checkbox', 'label' => 'Select all Manufacturers',
                                                'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']])
                                        ?>
            <?php } ?>
                <input type="file" name="file">


                <div class="radio vertical-radio m-l-15 p-t-10">
                    <?= $this->Form->radio(
                        'type',
                        [
                            ['value' => 'Standard Color', 'text' => 'Standard', 'checked' => 'checked'],
                            ['value' => 'Color 1', 'text' => 'Custom Colour'],
                            ['value' => 'Color 2', 'text' => 'Premium Colour'],
                            ['value' => 'Color 3', 'text' => 'Anodized'],
                            ['value' => 'Color 4', 'text' => 'Special Colour'],
                            ['value' => 'Door Configuration', 'text' => 'Configurations'],
                        ]
                    ) ?>
                </div>

                <div class="checkbox-primary m-l-15">
                    <?= $this->Form->input('deleteall',
                        ['type' => 'checkbox',
                            'label' => "Delete all data from selected dropdown before upload",
                            'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>
                </div>

                <?= $this->Form->Button('Upload csv', ['class' => 'btn btn-primary waves-effect update-values-btn btn-sm', 'type' => 'submit']) ?>



                <?= $this->Form->end() ?>
            </div>
        </div>


        <?= $this->Form->create($dropdowns, ['class' => 'delete-form' ,'url' => ['action' => 'delete'], 'type' => 'delete']) ?>
            <?= $this->Form->hidden('id', ['value' => '']) ?>
        <?= $this->Form->end() ?>


        <div class="col-md-6 col-sm-12 table-responsive">
            <table class="table table-hover drop-downs-table small-padding m-t-20">


                <tr>
                    <td><h5>Standard</h5></td>
                    <td>

                        <select id="standard" class="form-control">

                            <?php foreach ($dropdowns as $dropdown): ?>
                                <?php if ($dropdown->type == 'Standard Color'): ?>
                                    <option value="<?= $dropdown->id ?>"><?= h($dropdown->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td>

                        <?= $this->Form->button(__('Delete'), ['class' => 'btn btn-danger btn-delete btn-block waves-effect waves-light', 'data-type' => 'Standard Color']); ?>


                    </td>
                </tr>
                <tr>
                    <td><h5>Custom Colour</h5></td>
                    <td>

                        <select id="color1" class="form-control">

                            <?php foreach ($dropdowns as $dropdown): ?>
                                <?php if ($dropdown->type == 'Color 1'): ?>
                                    <option value="<?= $dropdown->id ?>"><?= h($dropdown->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td><?= $this->Form->button(__('Delete'), ['class' => 'btn btn-danger btn-delete btn-block waves-effect waves-light', 'data-type' => 'Color 1']); ?></td>
                </tr>
                <tr>
                    <td><h5>Premium Colour</h5></td>
                    <td>

                        <select id="color2" class="form-control">

                            <?php foreach ($dropdowns as $dropdown): ?>
                                <?php if ($dropdown->type == 'Color 2'): ?>
                                    <option value="<?= $dropdown->id ?>"><?= h($dropdown->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td><?= $this->Form->button(__('Delete'), ['class' => 'btn btn-danger btn-delete btn-block waves-effect waves-light', 'data-type' => 'Color 2']); ?></td>
                </tr>
                
                <tr>
                    <td><h5>Anodized</h5></td>
                    <td>

                        <select id="color3" class="form-control">

                            <?php foreach ($dropdowns as $dropdown): ?>
                                <?php if ($dropdown->type == 'Color 3'): ?>
                                    <option value="<?= $dropdown->id ?>"><?= h($dropdown->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td><?= $this->Form->button(__('Delete'), ['class' => 'btn btn-danger btn-delete btn-block waves-effect waves-light', 'data-type' => 'Color 3']); ?></td>
                </tr>
                
                <tr>
                    <td><h5>Special Colour</h5></td>
                    <td>

                        <select id="color4" class="form-control">

                            <?php foreach ($dropdowns as $dropdown): ?>
                                <?php if ($dropdown->type == 'Color 4'): ?>
                                    <option value="<?= $dropdown->id ?>"><?= h($dropdown->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td><?= $this->Form->button(__('Delete'), ['class' => 'btn btn-danger btn-delete btn-block waves-effect waves-light', 'data-type' => 'Color 4']); ?></td>
                </tr>
                
                

                <tr>
                    <td><h5>Configurations</h5></td>
                    <td>

                        <select id="conf" class="form-control">

                            <?php foreach ($dropdowns as $dropdown): ?>
                                <?php if ($dropdown->type == 'Door Configuration'): ?>
                                    <option value="<?= $dropdown->id ?>"><?= h($dropdown->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                    </td>
                    <td><?= $this->Form->button(__('Delete'), ['class' => 'btn btn-danger btn-delete btn-block waves-effect waves-light', 'data-type' => 'Door Configuration']); ?></td>
                </tr>


            </table>

            <hr>


            <table class="table table-hover drop-downs-table">

                <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                <tr>
                    <td><h5>Standard</h5></td>


                    <td>


                        <?= $this->Form->hidden('type', ['value' => 'Standard Color']) ?>
                        <?= $this->Form->input('name', ['class' => 'form-control', 'label' => false, 'value' => '']) ?>


                    </td>

                    <td>
                        <?= $this->Form->button(__('Add'), ['class' => 'btn btn-success btn-block waves-effect waves-light']); ?>
                    </td>

                </tr>

                <?= $this->Form->end() ?>


                <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                <tr>
                    <td><h5>Custom Colour</h5></td>


                    <td>


                        <?= $this->Form->hidden('type', ['value' => 'Color 1']) ?>
                        <?= $this->Form->input('name', ['class' => 'form-control', 'label' => false, 'value' => '']) ?>


                    </td>

                    <td>
                        <?= $this->Form->button(__('Add'), ['class' => 'btn btn-success btn-block waves-effect waves-light']); ?>
                    </td>

                    <td></td>

                </tr>

                <?= $this->Form->end() ?>
                <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>

                <tr>
                    <td><h5>Premium Colour</h5></td>


                    <td>


                        <?= $this->Form->hidden('type', ['value' => 'Color 2']) ?>
                        <?= $this->Form->input('name', ['class' => 'form-control', 'label' => false, 'value' => '']) ?>


                    </td>

                    <td>
                        <?= $this->Form->button(__('Add'), ['class' => 'btn btn-success btn-block waves-effect waves-light']); ?>
                    </td>

                    <td></td>

                </tr>

                <?= $this->Form->end() ?>
                
                <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>

                <tr class="conf-inputs">
                    <td><h5>Configurations</h5></td>


                    <td>


                        <?= $this->Form->hidden('type', ['value' => 'Door Configuration']) ?>
                        <?= $this->Form->input('name', ['class' => 'form-control', 'label' => false, 'value' => '']) ?>
                        <?= $this->Form->input('rule_code', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Code', 'value' => '']) ?>



                    </td>

                    <td>
                        <?= $this->Form->button(__('Add'), ['class' => 'btn btn-success btn-block waves-effect waves-light']); ?>
                    </td>

                    <td></td>

                </tr>

                <?= $this->Form->end() ?>
            </table>



        </div>


    </div>
</div>

<?= $this->Html->script('dropdown.js', ['block' => 'script']); ?>