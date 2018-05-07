<?php

$allMfs = [];
foreach ($mfs as $mf) {
    $allMfs[$mf->id] = $mf->username;
}
$system_platform = array('mx'=>'MX','pm'=>'PM','hybrid'=>'Hybrid');
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
                <?= $this->Form->input('business_abrev', ['class' => 'form-control','required']) ?>
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
		<div class="form-group">
            <div class="col-xs-12">
                <div class="btn-group system-platform" <?php if ($authUser['role'] == 'admin') echo 'style="display:none;"' ?>>
                    <?= $this->Form->input('system_platform', [
                        'options' => $system_platform,
                        'class' => 'form-control',
                        'label' => 'System Platfrom'
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
			<?php 
				$termValue = '<table cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*Estimate is subject to check measure Creadit card payment incurs 1% fee</td><td class="no-border" style="border:none !important;">*Installation includes any freight/delivery charges if applicable</td><td class="no-border" style="border:none !important;">Bank Details</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*This estimate is valid for 30 days*</td><td class="no-border" style="border:none !important;"><strong>Please use the Order No as your payment reference</strong></td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">Please sign and return as authorisation that you would like to proceed with this Estimate, but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and Conditions it in their entirety.</td></tr></tbody></table>';
			 ?>
			<div class="col-lg-10 col-md-10 col-xs-12">
				<input type="hidden" class="term_Defult" value='<table cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*Estimate is subject to check measure Creadit card payment incurs 1% fee</td><td class="no-border" style="border:none !important;">*Installation includes any freight/delivery charges if applicable</td><td class="no-border" style="border:none !important;">Bank Details</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">*This estimate is valid for 30 days*</td><td class="no-border" style="border:none !important;"><strong>Please use the Order No as your payment reference</strong></td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">&nbsp;</td></tr></tbody></table><table align="left" cellpadding="1" cellspacing="1"><tbody><tr><td class="no-border" style="border:none !important;">Please sign and return as authorisation that you would like to proceed with this Estimate, but please be aware in doing so that you have acknowledged this estimate and agree with the Terms and Conditions it in their entirety.</td></tr></tbody></table>'>
				<label>Terms</label>
				<div class="termDefult">Reset Default Terms</div>
				<div style="clear: both;">
					<?= $this->Form->textarea('terms', ['cols' => '80','rows' => '10','id' => 'editor1', 'class' => 'form-control','value' => $termValue]) ?>
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