<div class="card-box">
    <div class="row">
        <div class="col-sm-6">
            <?= $this->Form->create($installation, ['class' => 'form-horizontal', 'type' => 'POST']); ?>
            
            <table class="table table-bordered">

                <tr>
                    <th rowspan="2" class="vertical-middle">S/S, Perf, DG</th>
                    <th class="text-center">Window</th>
                    <th class="text-center">Door</th>
                </tr>
                <tr>
                    <td><?= $this->Form->input('window_amount', ['class' => 'form-control', 'label' => false]) ?></td>
                    <td><?= $this->Form->input('door_amount', ['class' => 'form-control', 'label' => false]) ?></td>
                </tr>
                <tr>
                    <th class="vertical-middle">Insect</th>
                    <td><?= $this->Form->input('insect_window_amount', ['class' => 'form-control', 'label' => false]) ?></td>
                    <td><?= $this->Form->input('insect_door_amount', ['class' => 'form-control', 'label' => false]) ?></td>
                </tr>
            </table>
            

            <?= $this->Form->Button('Save', ['class' => 'btn btn-primary waves-effect', 'type' => 'submit']) ?>

            <?= $this->Form->end() ?>
        </div>
    </div>

</div>