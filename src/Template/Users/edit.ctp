<nav class="large-3 medium-4 columns" id="actions-sidebar">

    <?php

    $allMfs = [];
    foreach ($mfs as $mf) {
        $allMfs[$mf->id] = $mf->username;
    }
	$system_platform = array('mx'=>'MX','pm'=>'PM','hybrid'=>'Hybrid');

    if ($authUser['role'] == 'admin') {
        ?>
        <ul class="side-nav">
            <li><?= $this->Html->link(__('All Users'), ['action' => 'index']) ?></li>
        </ul>
        <?php

    } elseif ($authUser['role'] == 'supplier') {
        ?>
        <ul class="side-nav">
            <li><?= $this->Html->link(__('All Users'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('All Manufacturers'), ['action' => 'manufacturers']) ?></li>
        </ul>
        <?php
    }
    echo '<h1><small>Edit Profile</small></h1>';
    ?>

</nav>


<div class="card-box">
    <?= $this->Form->create($user, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->hidden('parrentManufacturerId', array('value'=> $user->parent_id));?>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('username', ['class' => 'form-control', 'disabled' => 'disabled']) ?>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('email', ['class' => 'form-control']) ?>
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
            <?= $this->Form->input('new_password', ['class' => 'form-control', 'type' => 'password']) ?>
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
            <?= $this->Form->input('business_abrev', ['class' => 'form-control', 'disabled' => 'disabled']) ?>
        </div>
    </div>


    <?php if ($authUser['role'] == 'admin'): ?>
        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('role', ['options' => ['admin' => 'Admin', 'supplier' => 'Supplier',
                    'manufacturer' => 'Manufacturer', 'distributor' => 'Distributor',
                    'wholesaler' => 'Wholesaler', 'retailer' => 'Retailer', 'installer' => 'Installer', 'candidate' => 'candidate'],
                    'class' => 'form-control roles-dropdown']); ?>
            </div>
        </div>
    <?php elseif ($authUser['role'] == 'supplier' && !$isOwned): ?>
        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('role', ['options' => [
                    'manufacturer' => 'Manufacturer', 'distributor' => 'Distributor',
                    'wholesaler' => 'Wholesaler', 'retailer' => 'Retailer', 'installer' => 'Installer', 'candidate' => 'candidate'],
                    'class' => 'form-control roles-dropdown']); ?>
            </div>
        </div>
    <?php endif; ?>
	
    <div class="form-group">
        <div class="col-xs-12">
            <?php
            $style = '';
            $role = $user['role'];
            if ($role == 'admin' || $role == 'supplier' || $role == 'manufacturer' || $role == 'candidate') {
                $style = 'display:none;';
            }

            ?>
            <div class="btn-group allmfs" style="<?= $style; ?>">
                <?= $this->Form->input('parrentManufacturer', [
                    'options' => $allMfs,
                    'class' => 'form-control',
                    'value' => $user->parent_id,
                    'label' => 'Parent Manufacturer',
                    'disabled' => 'disabled'
                ]) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
		<div class="col-xs-12">
			<?php
            $style = '';
            $role = $user['role'];
			$systemPlatform = $user['system_platform'];
            if (($role == 'admin' || $role == 'supplier' || $role == 'manufacturer' || $role == 'candidate') && $systemPlatform != '') {
                $style = 'display:none;';
            }
            ?>
			<div class="btn-group system-platform" style="<?= $style; ?>">
				<?= $this->Form->input('system_platform', [
					'options' => $system_platform,
					'class' => 'form-control',
					'label' => 'System Platfrom',
					'disabled' => 'disabled'
				]) ?>
			</div>
		</div>
	</div>
    <div class="form-group">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->input('monthly_fee_report', ['class' => 'form-control','maxlength' => '10']) ?>
        </div>
    </div>
	<div class="form-group">
		<div class="col-lg-3 col-md-4 col-xs-12">
			<?= $this->Form->textarea('business_address', ['class' => 'form-control', 'placeholder' => 'Business Address']) ?>
		</div>
	</div>
	<div class="form-group">
		<?php if(isset($user->terms) && $user->terms != '' ){
			$termValue = $user->terms;
		}else{
			$termValue = '<table cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*Estimate is subject to check measure Creadit card payment incurs 1% fee</td><td class="no-border" style="border:none !important;">*Installation includes any freight/delivery charges if applicable</td><td class="no-border" style="border:none !important;">Bank Details</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*This estimate is valid for 30 days*</td><td class="no-border" style="border:none !important;"><strong>Please use the Order No as your payment reference</strong></td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">Please sign and return as authorisation that you would like to proceed with this Estimate, but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and Conditions it in their entirety.</td></tr></tbody></table>';
		} ?>
		<div class="col-lg-10 col-md-10 col-xs-12">
			<input type="hidden" class="term_Defult" value='<table cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*Estimate is subject to check measure Creadit card payment incurs 1% fee</td><td class="no-border" style="border:none !important;">*Installation includes any freight/delivery charges if applicable</td><td class="no-border" style="border:none !important;">Bank Details</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*This estimate is valid for 30 days*</td><td class="no-border" style="border:none !important;"><strong>Please use the Order No as your payment reference</strong></td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">Please sign and return as authorisation that you would like to proceed with this Estimate, but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and Conditions it in their entirety.</td></tr></tbody></table>'>
			<label>Terms</label>
			<div class="termDefult">Reset Default Terms</div>
			<div style="clear: both;">
				<?= $this->Form->textarea('terms', ['cols' => '80','rows' => '10','id' => 'editor1', 'class' => 'form-control','value' => $termValue]) ?>
			</div>
		</div>
	</div>
    <hr>
    <div class="form-group">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <h3>Printouts</h3>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-3 col-md-4 col-xs-12 upload-avatar-section">
            <?= $user->printout; ?>
            <input type="file" name="file" class="m-t-10">
        </div>
    </div>

    <?php if ($isOwned || $authUser['role'] == 'admin'): ?>
        <hr>
        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <h3>Banking</h3>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('bank_name', ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('bank_account_name', ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('bsb', ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('bank_account_number', ['class' => 'form-control']) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?= $this->Form->input('deposit_percent', ['class' => 'form-control']) ?>
            </div>
        </div>

    <?php endif; ?>

    <div class="form-group text-center m-t-40">
        <div class="col-lg-3 col-md-4 col-xs-12">
            <?= $this->Form->button(__('Save changes'), ['class' => 'btn btn-info btn-block text-uppercase waves-effect waves-light']); ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>


<?= $this->Html->script('add-user.js', ['block' => 'script']); ?>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.1/classic/ckeditor.js"></script> -->


<!-- <script>
    ClassicEditor
        .create( document.querySelector( '#terms' ) )
        .catch( error => {
            console.error( error );
        } );
</script> -->