<h1>
    <small><?= __('Edit Content') ?></small>
</h1>
<div class="card-box">
    
    <?= $this->Form->create($content, ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) ?>
    
    <div class="form-group ">
        <div class="col-lg-4 col-md-4 col-xs-12">
            <?= $this->Form->input('label', ['class' => 'form-control', 'disabled' => 'disabled']) ?>
        </div>
    </div>
    
    <div class="form-group ">
        <div class="col-lg-4 col-md-4 col-xs-12">
            <?= $this->Form->input('title', ['class' => 'form-control']) ?>
        </div>
    </div>
    
    <div class="form-group ">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= $this->Form->textarea('description', ['id' => 'description', 'class' => 'form-control']) ?>
        </div>
    </div>
    
    <div class="form-group text-center m-t-40">
        <div class="col-lg-1 col-md-4 col-xs-12">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-info btn-block text-uppercase waves-effect waves-light']); ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>