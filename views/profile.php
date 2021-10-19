<?php 
    /** @var $this \app\core\View */

use app\core\Application;

$this->title = 'Chatting... but your message is show for everyone lmao';
?>

<div class="container">
    <br>
    <h2>Send a message to him (her)</h2>
    <br>
    <form action="/profile" method="post" enctype="multipart/form-data">
    <div class="input-group">
                    <input class="form-control form-control-lg" id="text" type="text" name="receiver" placeholder="Enter receiver's name" autofocus required>
                    <input class="form-control form-control-lg" id="text" type="text" name="message" placeholder="Write something..." required>
                    <button class="btn btn-outline-primary btn-lg" id="submit" type="submit" name="submit">Send</button>
                </div>
    </form>
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
    <th scope='col'>Receiver</th>
    </tr>
    </thead>";
    ?>
    <?php


$sender = Application::$app->user->getDisplayName();
try {
    $conn = new PDO("mysql:host=sql6.freemysqlhosting.net;dbname=sql6445102", 'sql6445102', 't7JZbAcjpP');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT sender, content, receiver FROM message");
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
      <td><?php echo $result['receiver']?></td>
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
    Application::$app->response->redirect('/profile');
}
catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}
}
$conn = null;
echo "</table>";
?>
<br>
<br>
<p>"Nhất ngôn xuất ký, tứ mã nan truy", so we decide not to add edit message feature. Write anything carefully hehe.</p>
</div>
