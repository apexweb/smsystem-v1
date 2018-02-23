<?php

$allMfs = [];
foreach ($mfs as $mf) {
    $allMfs[$mf->id] = $mf->username;
}

?>


    <h1>Add User</h1>


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
        
        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('business_name', ['class' => 'form-control']) ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('business_abrev', ['class' => 'form-control']) ?>
            </div>
        </div>
        
            
        <div class="form-group">
            <div class="col-xs-12">
                <div class="btn-group">

                    <?php if ($authUser['role'] == 'admin'): ?>
                        <?= $this->Form->input('role', [
                            'options' => ['admin' => 'Admin', 'supplier' => 'Supplier', 'manufacturer' => 'Manufacturer',
                                'distributor' => 'Distributor', 'wholesaler' => 'Wholesaler', 'installer' => 'Installer',
                                'retailer' => 'Retailer', 'candidate' => 'Candidate',],
                            'class' => 'form-control roles-dropdown'
                        ]) ?>

                    <?php else: ?>
                        <?= $this->Form->input('role', [
                            'options' => [
                                'distributer' => 'Distributer', 'wholesaler' => 'Wholesaler',
                                'retailer' => 'Retailer', 'installer' => 'Installer','candidate' => 'Candidate'],
                            'class' => 'form-control roles-dropdown'
                        ]) ?>


                    <?php endif; ?>


                </div>
            </div>
        </div>
        
        


        <div class="form-group">
            <div class="col-xs-12">
                <div class="btn-group allmfs" <?php if ($authUser['role'] == 'admin') echo 'style="display:none;"' ?>>
                    <?= $this->Form->input('parrentManufacturer', [
                        'options' => $allMfs,
                        'class' => 'form-control',
                        'label' => 'Parent Manufacturer'
                    ]) ?>
                </div>
            </div>
        </div>
        
        <?php if ($authUser['role'] == 'admin'): ?>        
        
            <div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
                <input type="checkbox" name="send_notification" value="1">
                <label>Send a notification</label>
            </div>    
        
        <?php endif; ?>

        <div class="form-group text-center m-t-40">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->button(__('Add'), ['class' => 'btn btn-info btn-block text-uppercase waves-effect waves-light']); ?>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>
<?= $this->Html->script('add-user.js', ['block' => 'script']); ?>