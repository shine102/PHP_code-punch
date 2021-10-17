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
</tr>
</thead>";

try {
  $conn = new PDO("mysql:host=localhost;dbname=php_mvc", 'root');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT Id, fullname, email, number, username, Admin FROM Student");
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
<a class="btn btn-primary" href="/register" role="button">Add a student</a>
<a class="btn btn-primary" href="/delete" role="button">Delete a student</a>
<a class="btn btn-primary" href="/profile" role="button">Send a message</a>
<?php else:?>
<a class="btn btn-primary" href="/profile" role="button">Send a message</a>
<?php endif;?>