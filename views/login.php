<?php
  /** @var $model \app\models\Login */

?>
<?php $this->title = 'Login here' ?>


<div class="container text-center" style="width: 50%;">
<h1>Login</h1>
<?php
use app\core\form\Form;
$form = Form::begin('', "post") ?>
  <?php echo $form->field($model, 'username');?>
  <?php echo $form->field($model, 'password')->passwordField();?>
  
  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end()?>
</div>