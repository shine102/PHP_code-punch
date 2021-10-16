<?php $this->title = 'Rewrite you identity' ?>

<div class="container text-center" style="width: 40%;">
<h1>Change your info here</h1>
<p>For things your don't want to change, you still have to fill the form, it is required</p>
<?php
use app\core\form\Form;
$form = Form::begin('', "post") ?>
  <?php echo $form->field($model, 'number')->numberField();?>
  <?php echo $form->field($model, 'email');?>
  <?php echo $form->field($model, 'password')->passwordField();?>
  <?php echo $form->field($model, 'passwordConfirm')->passwordField();?>

  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end()?>
</div>