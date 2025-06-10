<?php
if (isset($_SESSION['flash']['Errors validation'])) {
  $errors = $_SESSION['flash']['Errors validation'];
}


?>

<h1>Register page</h1>

<form action="" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
    <?php
    if (isset($errors['name'])) {
      echo $errors['name'];
    }
    ?>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">

    <?php
    if (isset($errors['email'])) {
      echo $errors['email'];
    }
    ?>

  </div>

  <div class="mb-3">
    <label for="tel" class="form-label">Phone</label>
    <input type="text" class="form-control" id="tel" name="tel">

    <?php
    if (isset($errors['tel'])) {
      echo $errors['tel'];
    }
    ?>


  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">

    <?php
    if (isset($errors['password'])) {
      echo $errors['password'];
    }
    ?>


  </div>
  <div class="mb-3">
    <label for="password-confirm" class="form-label">Password confirm</label>
    <input type="password" class="form-control" id="password-confirm" name="password-confirm">

    <?php
    if (isset($errors['password-confirm'])) {
      echo $errors['password-confirm'];
    }
    ?>


  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>

