<?php $this->title = 'Eliminate...' ?>

<div class="container text-center" style="width: 40%;">
<h1>Delete a student</h1>
<p>Just enter the username of that student, we will do the rest</p>
<?php

use app\core\Application;
use app\core\form\Form;
$form = Form::begin('', "post") ?>
  <?php if(Application::isTeacher()):?>
  <?php echo $form->field($model, 'username');?>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php else:?>  
  <?php Application::$app->response->redirect('/')?>
  <?php endif;?>
  
<?php Form::end()?>
</div>