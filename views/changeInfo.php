<?php $this->title = 'Rewrite you identity' ?>

<div class="container text-center" style="width: 40%;">
<h1>Change the info here</h1>
<p>For things your don't want to change, you still have to fill the form, it is required. Username must be same as the old one (for Teacher)</p>
<?php

use app\core\Application;
use app\core\form\Form;
$form = Form::begin('', "post") ?>
  <?php if(Application::isTeacher()):?>
  <?php echo $form->field($model, 'fullname');?>
  <?php endif;?>
  <?php echo $form->field($model, 'number')->numberField();?>
  <?php echo $form->field($model, 'email');?>
  <?php if(Application::isTeacher()):?>
  <?php echo $form->field($model, 'username');?>
  <?php endif;?>
  <?php echo $form->field($model, 'password')->passwordField();?>
  <?php echo $form->field($model, 'passwordConfirm')->passwordField();?>

  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end()?>
</div>