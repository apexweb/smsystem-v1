<?php if(isset($role) && $role == 'supplier' && isset($_GET['mf'])){ ?>
<?= $this->Form->create(null, ['class' => 'form-horizontal', 'url' => ['action' => 'custompartsdefine']]); ?>
<?php } ?>
<table id="datatable" class="table table-striped table-bordered table-hover small-padding all-parts table-responsive">
	<thead>
	<tr>
		
		<?php if(isset($role) && $role == 'supplier' && isset($_GET['mf'])){ ?>
		<th></th>
		<?php } ?>
		<th id="sortTitle">Title <div class="customSort"></div></th>
		<th id="sortCode">Code <div class="customSort"></div></th>
		<th id="sortPart">Part No. <div class="customSort"></div></th>
		<th id="sortSupplier">Supplier <div class="customSort"></div></th>
		<th>Buy price include GST</th>
		<th>Unit</th>
		<th>Size</th>
		<th>Marked up Price</th>
		<th>Mark up %</th>
		<th>Price per unit</th>
		<th>Per M</th>
		<th>Per Ln</th>
		<th>Acc</th>
		<th>MC</th>
		<th>Created Date</th>
		<th colspan="2">Edit / Delete</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$commonIDs = [];
	foreach($usersPartID as $usersPartIDs){
		$commonIDs[] = $usersPartIDs->part_id;
	} 
	$checked = '';
	foreach ($parts as $part): ?>
		<?php
		if (in_array($part->id, $commonIDs)){
			$checked = 'checked="checked"';
		}else{
			$checked = '';
		} ?>
		<tr>
			<?php if(isset($role) && $role == 'supplier' && isset($_GET['mf'])){ ?>
			<td>
				<div class="checkbox checkbox-custom checkbox-single">
					<input type="checkbox" name="userParts[]" value="<?= $part->id ?>" <?= $checked ?>>
					<label></label>
				</div>
			</td>
			<?php } ?>
			
			<td><?= $part->part->title ?></td>
			<td><?= $part->part->part_code ?></td>
			<td><?= $part->part->part_number ?></td>
			<td><?= $part->part->supplier ?></td>
			<td><?= $part->buy_price_include_GST ?></td>
			<td><?= $part->unit ?></td>
			<td><?= $part->size ?></td>
			<td><?= $part->marked_up ?></td>
			<td><?= $part->mark_up ?></td>
			<td><?= $part->price_per_unit ?></td>
			<td>
				<?php if ($part->show_in_additional_section_dropdown): ?>
					<div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
						<input type="checkbox" disabled="disabled" checked="checked">
						<label></label>
					</div>
				<?php endif; ?>
			</td>
			<td>
				<?php if ($part->show_in_additional_section_by_length_dropdown): ?>
					<div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
						<input type="checkbox" disabled="disabled" checked="checked">
						<label></label>
					</div>
				<?php endif; ?>
			</td>
			<td>
				<?php if ($part->show_in_accessories_dropdown): ?>
					<div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
						<input type="checkbox" disabled="disabled" checked="checked">
						<label></label>
					</div>
				<?php endif; ?>
			</td>
			<td>
				<?php if ($part->master_calculator_value): ?>
					<div class="checkbox checkbox-custom checkbox-single" style="margin:0px;">
						<input type="checkbox" disabled="disabled" checked="checked">
						<label></label>
					</div>
				<?php endif; ?>
			</td>

			<td><?= $part->part->created->format('d/m/Y'); ?></td>
			
			<td>
				<?= $this->Html->link('Edit', ['action' => 'edit', $part->part_id]) ?>
				
				<?php if($role != 'supplier'){ ?>
					<span> / </span>
					<?= $this->Form->postLink('Delete', ['action' => 'delete', $part->id], ['confirm' => 'Are you sure?']) ?>
				<?php } ?>
			</td>

		</tr>
	<?php endforeach; ?>
	<?php if (isset($_GET['mf'])): ?>
		<td><input type="hidden" name="userID" value="<?php echo $_GET['mf']; ?>" ></td>
	<?php endif; ?>
	
	</tbody>
</table>
<?php if(isset($role) && $role == 'supplier' && isset($_GET['mf'])){ ?>
<div class="form-group">
	<?= $this->Form->Button('Submit', ['class' => 'btn btn-primary waves-effect update-values-btn btn-sm', 'type' => 'submit']) ?>
</div>

<?= $this->Form->end(); ?>
<?php } ?>