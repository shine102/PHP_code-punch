<?php 
    /** @var $this \app\core\View */

use app\core\Application;

$this->title = 'List User, nothing really useful';
?>
<div class="container text-center">
<h1>User List </h1>
<?php
echo "<table class='table table-striped table-hover'>";
echo "<thead>";
echo "   <tr>
<th>Fullname</th>
<th>Email</th>
<th>Phone Number</th>
<th>Username</th>
<th>Teacher</th>
<th>Send a message</th>
</tr>
</thead>";

try {
  $conn = new PDO("mysql:host=sql6.freemysqlhosting.net;dbname=sql6445102", 'sql6445102', 't7JZbAcjpP');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT Id, fullname, email, number, username, Admin FROM student");
  $stmt->execute();
  $results = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  echo "<tbody>";
  foreach ($results as $result):
     ?>
    
    <tr class="align-middle">
      <td><?php echo $result['fullname']?></td>
      <td><?php echo $result['email']?></td>
      <td><?php echo $result['number']?></td>
      <td><?php echo $result['username']?></td>
      <td><?php if($result['Admin'] == 1){
            echo "Yes";
          }
          else{
              echo "No";
          }?></td>
      <td> 
        <a class="btn btn-outline-dark btn-sm" href="/profile?receiver=<?php echo $result['username']?>" role="button">Link</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
<?php
$conn = null;
echo "</table>";
?>

<br>
<br>
<?php if(Application::isTeacher()) : ?>
<a class="btn btn-outline-dark" href="/register" role="button">Add a student</a>
<a class="btn btn-outline-dark" href="/delete" role="button">Delete a student</a>
<?php endif;?>
</div>