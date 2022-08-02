<?php
/** @var $this \walumbe\phpmvc\View */
$this->title = 'Login';

/** @var $model \app\models\User */
?>
<h1>Login</h1>
<?php $form = \walumbe\phpmvc\form\Form::begin('', 'post'); ?>

<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordField() ; ?>
<button class="btn btn-success">Submit</button>

<?php echo \walumbe\phpmvc\form\Form::end() ?>
