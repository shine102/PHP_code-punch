<?php 
    /** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Send your love to them...';
$real = $_GET['receiver'] ?? '';
?>

<div class="container text-center" style="width:60%">
  <?php if($real !== ''): ?>
    <br>
    <h2>Send a message to him (her)</h2>
    <br>
<p>"Nhất ngôn xuất ký, tứ mã nan truy", so we decide not to add edit message feature. Write anything carefully hehe.</p>
    <br>
    <form action="/profile" method="post" enctype="multipart/form-data">
    <div class="input-group">
      <input class="form-control form-control-lg" id="text" type="hidden" name="receiver" value="<?php echo $_GET['receiver'] ?? '';?>" required>
      <input class="form-control form-control-lg" id="text" type="text" name="message" placeholder="Write something..." required autofocus>
      <button class="btn btn-outline-primary btn-lg" id="submit" type="submit" name="submit">Send</button>
      </div>
    </form>
    <?php endif; ?>
    <div class="container-sm">
    <br>
    <br>
    <h3>Message list </h3>
    <?php
    echo "<table class='table'>";
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
    $conn = new PDO("mysql:host=sql6.freemysqlhosting.net;dbname=sql6445102", 'sql6445102', 't7JZbAcjpP');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT sender, content, receiver FROM message WHERE receiver='$sender'");
    $stmt->execute();
    $results = $stmt->fetchAll();
  } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    foreach($results as $result):
    ?>
    <tbody>
    <tr>
      <th scope='row'><?php echo $result['sender']?></th>
      <td><?php echo $result['content']?></td>
    </td>
    </tr>
  </tbody>
  <?php endforeach; ?>

<?php
if (Application::$app->request->isPost()){
try {
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

</div>
