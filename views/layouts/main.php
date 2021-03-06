<?php use app\core\Application;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link rel="icon" href="\img\favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
  
    <title><?php echo $this->title ?></title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
    <img src="\img\1.png" width="30" height="30" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
      </ul>
<?php if(Application::isGuest()): ?>
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Register</a>
        </li>
      </ul>
<?php else: ?>
  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/userlist">User List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homeworkgive">Homework</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/gameplay">Playing a game</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/changeInfo">Change student info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/profile">Profile</a>
        </li>
      </ul>
  <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/logout">Welcome <?php echo Application::$app->user->getDisplayName()?>
          (Logout)
        </a>
        </li>
  </ul>
<?php endif; ?>
    </div>
  </div>
</nav>
<div class="container">
<?php

if(Application::$app->session->getFlash('success')): ?>
<div class="alert alert-success">
  <?php echo Application::$app->session->getFlash('success') ?>
</div>
<?php endif; ?>
{{content}}
</div>
<br>
<br>
<br>
<container>
<nav class="nav justify-content-center navbar-dark bg-dark fixed-bottom">
  <div class="nav-item">
    <a class="nav-link active" href="https://www.facebook.com/ehc.fptu">
    <strong style="color:azure"> EHC - Ethical Hacker Club </strong>
    </a>
  </div>
  <div class="nav-item">
    <a class="nav-link active" href="/about">
    <strong style="color:azure"> About Us </strong>
    </a>
  </div>
</nav>
</container>
  
  </body>
</html>
