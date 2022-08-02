<?php

/** @var $this \walumbe\phpmvc\View*/
/** @var $model \app\models\ContactForm*/

use walumbe\phpmvc\form\TextareaField;

$this->title = 'Contact';
?>
<h1>Contact Us</h1>

<?php $form = \walumbe\phpmvc\form\Form::begin('', 'post'); ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php $form = \walumbe\phpmvc\form\Form::end(); ?>
