<?php 
    /** @var $this \app\core\View */

use app\core\Application;

$this->title = 'List User, nothing really useful';
?>
<div class="container-sm">
<h1>User List </h1>
<?php
echo "<table class='table'>";
echo "<thead>";
echo "   <tr>
<th scope='col'>Fullname</th>
<th scope='col'>Email</th>
<th scope='col'>Phone Number</th>
<th scope='col'>Username</th>
<th scope='col'>Teacher</th>
<th scope='col'>Send a message</th>
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
  foreach ($results as $result):
     ?>
    <tbody>
    <tr>
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
        <a class="btn btn-link text-nowrap" href="/profile?receiver=<?php echo $result['username']?>" role="button">Link</a></td>
    </tr>
  </tbody>
  <?php endforeach; ?>
<?php
$conn = null;
echo "</table>";
?>
</div>
<br>
<br>
<?php if(Application::isTeacher()) : ?>
<a class="btn btn-light" href="/register" role="button">Add a student</a>
<a class="btn btn-light" href="/delete" role="button">Delete a student</a>
<?php endif;?>