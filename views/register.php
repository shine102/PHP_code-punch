<?php

use app\core\Application;

$this->title = 'Someone start a new life here...' ?>

<div class="container text-center" style="width: 40%;">
<h1>Create a new 
  <?php if(Application::isGuest()){
    echo 'teacher account';
  }
  else {
    echo 'student account';
  }?>
</h1>
<?php
use app\core\form\Form;
$form = Form::begin('', "post") ?>
  <?php echo $form->field($model, 'fullname');?>
  <?php echo $form->field($model, 'number')->numberField();?>
  <?php echo $form->field($model, 'email');?>
  <?php echo $form->field($model, 'username');?>
  <?php echo $form->field($model, 'password')->passwordField();?>
  <?php echo $form->field($model, 'passwordConfirm')->passwordField();?>

  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end()?>
</div>