<?php

use app\core\Application;
$this->title = 'Have fun... or not XD';
?>
<div class="container text-center" style="width:60%">
<h1>Gamelist</h1>
</div>
<?php 
  echo "<table class='table'>";
  echo "<thead>";
  echo "   <tr>
  <th scope='col'>No.</th>
  <th scope='col'>Author</th>
  <th scope='col'>Hint</th>
  </tr>
  </thead>";
  
  try {
    $conn = new PDO("mysql:host=sql6.freemysqlhosting.net;dbname=sql6445102", 'sql6445102', 't7JZbAcjpP');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT Id, name, author, hint FROM game");
    $stmt->execute();
    $results = $stmt->fetchAll();
  } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    foreach ($results as $result):
      $filename =  __DIR__ . "/../public/runtime/" .$result['name'];
      $resultname = $result['name'];
       ?>
      <tbody>
      <tr>
        <td><?php echo $result['Id']?></td>
        <td><?php echo $result['author']?></td>
        <td><?php echo $result['hint']?> </td>
      </tr>
    </tbody>
    <?php endforeach; ?>
  </table>
<br>
<div class="container text-center" style="width:60%">
    <?php  if (Application::isTeacher()): ?> 
    <form action="/gameplay" method="post" enctype="multipart/form-data">
        <label for="formFile" class="form-label">Upload file, trick you student</label>
        <input class="form-control" type="file" id="formFile" name="formFile" required>
        <br>
        <p>Add hint</p>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required autofocus name="hint" id="hint">
        <br>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
    </form>


    <?php else:  ?>
    <form action="/gameplay" method="post">
        <p>Submit your answer</p>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required autofocus name="answer" id="answer">
        <br>
        <input class="btn btn-primary" type="submit" value="Submit" name="submit">
    </form>
    <?php endif; ?>

<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (Application::$app->request->isPost()){
    if (Application::isTeacher()){
        $target_dir =  __DIR__ . "/../public/runtime/";
        $target_file = $target_dir . basename($_FILES["formFile"]["name"]);
        $uploadOk = 1;
        $txtFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists. ";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["formFile"]["size"] > 500000) {
            echo "Sorry, your file is too large. ";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($txtFileType != "txt") {
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
            $hint = test_input($_POST['hint']);
            $name = $_FILES['formFile']['name'];
            $author = Application::$app->user->getDisplayName();
            $stmt = $conn->prepare("INSERT INTO game (name, author, hint) VALUES ('$name','$author', '$hint' ) ");
            $stmt->execute();
            Application::$app->response->redirect("/gameplay");
            } else {
            echo "Sorry, there was an error uploading your file. ";
            }
        }
    }
  else {
    $flag = false;
    $answer = test_input($_POST['answer']);
    foreach ($results as $result) {
      if ($answer . ".txt" === $result['name']){
          echo "<p>Congrattttttt</p>";
          echo file_get_contents(  __DIR__ . "/../public/runtime/" . $result['name']); 
          echo "<br>" ;
          echo "<br>" ;
          echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/3Nz2Tf9Drp8?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
          $flag = true;
      } 
    }
    if ($flag === false){
      echo "Wrong, please think carefully";
      echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/uMfu7pExrQA?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>" >';
    } 

  }

}
$conn = null;
  ?>

</div>