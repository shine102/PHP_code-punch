<?php

use app\core\Application;

$this->title = 'Wellcome to hell' ?>
<div class="container text-center">
<h1>Homework</h1>
<?php
echo "<table class='table table-striped table-hover'>";
echo "<thead>";
echo "   <tr>
<th scope='col'>Name</th>
<th scope='col'>Author</th>
<th scope='col'>Download</th>
<th scope='col'>Submit</th>";
if (Application::isTeacher()) {
  echo "<th scope='col'>Delete</th>";
}
echo "
</tr>
</thead>";

try {
  $conn = new PDO("mysql:host=sql6.freemysqlhosting.net;dbname=sql6445102", 'sql6445102', 't7JZbAcjpP');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT Id, name, author FROM homework");
  $stmt->execute();
  $results = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  
  foreach ($results as $result):
    //đường dẫn khi bấm vào nút dowload
    $filename = $result['name'];
     ?>
    <tbody>
    <tr>
      <td><?php echo $result['name']?></td>
      <td><?php echo $result['author']?></td>
      <td><?php echo ' <a class="btn btn-outline-dark btn-sm" href="' . "/homework/given/". $filename . '"> Download </a>' ?> </td>
      <td><a class="btn btn-outline-dark btn-sm" href="\upload">Link</a></td>
      <?php if(Application::isTeacher()) {
        $name = $result['name'];
        echo "<td><a class='btn btn-outline-dark btn-sm' href='\hwdelete?name=$name' role = 'button'> Link </a> </td>";
      } ?>
    </tr>
  </tbody>
  <?php endforeach; ?>
</table>
<?php if(Application::isTeacher()):?>
  <form action="/homeworkgive" method="post" enctype="multipart/form-data">
  <label for="formFile" class="form-label">Still not enough? Your student still have time? Choose a homework file to upload</label>
  <input class="form-control" type="file" id="formFile" name="formFile" required>
  <br>
  <input class="btn btn-outline-dark" type="submit" value="Submit" name="submit">
</form>


<?php

if (Application::$app->request->isPost()){
  
  $target_dir =  __DIR__ . "/../public/homework/given/";
  $target_file = $target_dir . basename($_FILES["formFile"]["name"]);
  $uploadOk = 1;
  $pdfFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
      $name = $_FILES['formFile']['name'];
      $author = Application::$app->user->getDisplayName();
      $stmt = $conn->prepare("INSERT INTO homework (name, author) VALUES ('$name','$author') ");
      $stmt->execute();
      $conn = null;
      Application::$app->response->redirect("/homeworkgive");
    } else {
      echo "Sorry, there was an error uploading your file. ";
    }
  }
}
?>
<?php endif;?>

</div>