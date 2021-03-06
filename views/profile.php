<?php 
    /** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Send your love to them...';
$real = $_GET['receiver'] ?? '';
?>

<div class="container text-center" style="width:60%">
  <?php if($real !== ''): ?>
    <br>
    <h2>Send a message to <?php echo $_GET['receiver']?></h2>
    <br>
    <p>"Nhất ngôn xuất ký, tứ mã nan truy", so we decide not to add edit message feature. Write anything carefully hehe.</p>
    <br>
    <form action="/profile" method="post" enctype="multipart/form-data">
    <div class="input-group">
      <input class="form-control form-control-lg" id="text" type="hidden" name="receiver" value="<?php echo $_GET['receiver'] ?? '';?>" required>
      <input class="form-control form-control-lg" id="text" type="text" name="message" placeholder="Write something..." required autofocus>
      <button class="btn btn-outline-dark btn-lg" id="submit" type="submit" name="submit">Send</button>
      </div>
    </form>
    <?php else : ?>
    <div class="container-sm">
    <br>
    <br>
    <h1>Message list </h1>
    <?php
    echo "<table class='table table-striped table-hover'>";
    echo "<thead>";
    echo "   <tr>
    <th scope='col'>Sender</th>
    <th scope='col'>Message</th>
    </tr>
    </thead>";
    ?>
    <?php
$sender = Application::$app->user->getUsername();
try {
    $dsn = $_ENV['dsn'];
    $user = $_ENV['user'];
    $password = $_ENV['password'];
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT sender, content, receiver FROM message WHERE receiver='$sender'");
    $stmt->execute();
    $results = $stmt->fetchAll();
  } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    echo "<tbody>";
    foreach($results as $result):
    ?>
    
    <tr>
      <th scope='row'><?php echo $result['sender']?></th>
      <td><?php echo $result['content']?></td>
    </td>
    </tr>

  <?php endforeach; ?>
  </tbody>

<?php
if (Application::$app->request->isPost()){
try {
    $_POST['message'] = filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);
    $_POST['receiver'] = filter_var($_POST['receiver'], FILTER_SANITIZE_SPECIAL_CHARS);
    $stmt = $conn->prepare("INSERT INTO message (sender, content , receiver)
                     VALUES ( '$sender', '$_POST[message]', '$_POST[receiver]' ) ");
    $stmt->execute();
    Application::$app->response->redirect('/userlist');
}
catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
}
$conn = null;
echo "</table>";
?>
<?php endif; ?>
</div>
