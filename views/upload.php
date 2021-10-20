<?php

use app\core\Application;

$this->title = 'Win the deadline' ?>

<?php if (! Application::isTeacher()) :?>
<div class="container-md text-center" style="width:60%">
  <form action="/upload" method="post" enctype="multipart/form-data">
  <label for="formFile" class="form-label"><h2>Kick deadline out of your life</h2></label>
  <input class="form-control" type="file" id="formFile" name="formFile" required>
  <br>
  <input class="btn btn-primary" type="submit" value="Submit" name="submit">
</form>
</div>

<?php else:
    echo "<h1>File uploaded list: </h1>";
    $fileList = glob(__DIR__ ."/../public/homework/receive/*");
    foreach($fileList as $filename){
        if(is_file($filename)){
            $target = basename("$filename",".pdf").PHP_EOL;
            echo $target . '<a href="' . "/homework/receive/". "$target". ".pdf" . '"> Download file here </a>' , '<br>';
    }
}
?>
<?php endif; ?>

<?php

if (Application::$app->request->isPost()){
  $target_dir = __DIR__ ."/../public/homework/receive/";
  $target_file = $target_dir . basename($_FILES["formFile"]["name"]);
  $uploadOk = 1;
  $pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists. ";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["formFile"]["size"] > 5000000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($pdfFileType != "pdf") {
    echo "Sorry, only PDF files are allowed. ";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. ";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["formFile"]["tmp_name"], $target_file)) {
      echo "The file has been uploaded. ";
    } else {
      echo "Sorry, there was an error uploading your file. ";
    }
  }
}
  ?>