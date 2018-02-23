<!-- File: src/Template/Users/register.ctp -->


<?= $this->Flash->render('auth') ?>

<?= $this->Form->create('Register', ['class' => 'form-horizontal']) ?>


<div class="form-group ">
    <div class="col-xs-12">

        <?= $this->Form->input('email', ['class' => 'form-control']) ?>

    </div>

</div>

<div class="form-group ">
    <div class="col-xs-12">

        <?= $this->Form->input('username', ['class' => 'form-control']) ?>

    </div>

</div>

<div class="form-group">
    <div class="col-xs-12">

        <?= $this->Form->input('password', ['class' => 'form-control']) ?>

    </div>

</div>

<div class="form-group">
    <div class="col-xs-12">

        <?= $this->Form->input('confirm_password', ['class' => 'form-control', 'type' => 'password']) ?>

    </div>

</div>


<div class="form-group">
    <div class="col-xs-12">
        <div class="checkbox checkbox-primary">

            <?= $this->Form->input('agreed', array('type' => 'checkbox', 'label' => 'Terms and Conditions'), array('value' => '0')) ?>
        </div>
    </div>
</div>

<div class="form-group text-center m-t-40">
    <div class="col-xs-12">

        <?= $this->Form->button(__('Register'), ['class' => 'btn btn-info btn-block text-uppercase waves-effect waves-light']); ?>

    </div>
</div>
