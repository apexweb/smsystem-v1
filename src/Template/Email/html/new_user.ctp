<?php use Cake\Routing\Router;?>
<?php $url = Router::url(array("controller"=>"users","action"=>"login"),true);?>
<div
    style="font-size: 14px; color: #4f4f4f; font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <h4>Hello! Welcome to SMS Screen Management System</h4>
    <br>
    <p>Your account information are as follows:</p>
    <p>Username: <strong><?= $user->username; ?></strong></p>
    <p>Password: <strong><?= $user->confirm_password; ?></strong></p>
    <p>Role: <strong><?= $user->role ?></strong></p>
    <p>You can simply change the other information in Edit Profile page. Login <strong><a href="<?php echo $url;?>">here</a></strong> to access your account.</p>
</div>
