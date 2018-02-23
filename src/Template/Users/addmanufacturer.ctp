<h1>Add Manufacturer</h1>


<div class="card-box">
    <?= $this->Form->create($user, ['class' => 'form-horizontal']) ?>


    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">

            <?= $this->Form->input('email', ['class' => 'form-control']) ?>

        </div>
    </div>
    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('username', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('firstname', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('lastname', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('password', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('confirm_password', ['class' => 'form-control', 'type' => 'password']) ?>
        </div>
    </div>


    <div class="form-group text-center m-t-40">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->button(__('Add'), ['class' => 'btn btn-info btn-block text-uppercase waves-effect waves-light']); ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>
