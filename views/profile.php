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
                    <input class="form-control form-control-lg" id="text" type="text" name="text" placeholder="Write something..." autofocus>
                    <button class="btn btn-outline-primary btn-lg" id="submit" type="submit" name="submit">Send</button>
                </div>
    </form>
    <?php

$sender = Application::$app->user->getDisplayName();
echo $sender;
try {
    $conn = new PDO("mysql:host=localhost;dbname=php_mvc", 'root');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT sender, content FROM message");
    $stmt->execute();
    $results = $stmt->fetchAll();
  } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    ?>

<?php
$conn = null;
echo "</table>";
?>
</div>
