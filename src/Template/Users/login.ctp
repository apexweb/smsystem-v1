<!-- File: src/Template/Users/login.ctp -->

<?= $this->Form->create('Login',['class'=>'form-horizontal']) ?>




<div class="form-group ">
    <div class="col-xs-12">
        <input class="form-control" type="text" name="username" required="" placeholder="Username">
    </div>
</div>

<div class="form-group">
    <div class="col-xs-12">
        <input class="form-control" type="password" name="password" required="" placeholder="Password">
    </div>
</div>

<div class="form-group ">
    <div class="col-xs-12">
        <div class="checkbox checkbox-primary">
            <input id="checkbox-signup" type="checkbox" name="remember_me">
            <label for="checkbox-signup">
                Remember me
            </label>
        </div>

    </div>
</div>

<div class="form-group text-center m-t-40">
    <div class="col-xs-12">
        <?= $this->Form->button(__('Login'), ['class'=>'btn btn-info btn-block text-uppercase waves-effect waves-light']); ?>


    </div>
</div>

<div class="form-group m-t-30 m-b-0">
    <div class="col-sm-12">
        <a href="page-recoverpw.html" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
    </div>
</div>
<?= $this->Form->end() ?>