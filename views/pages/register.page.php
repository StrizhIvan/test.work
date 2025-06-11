<?php
if (isset($_SESSION['flash'])) {
  $errors = $_SESSION['flash'];
}
?>

<h1>Register page</h1>
<?php 
if (isset($errors['Register error'])) {
  echo $errors['Register error'];
}
?>
<form action="" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
    <?php
    if (isset($errors['Errors validation']['name'])) {
      echo $errors['Errors validation']['name'];
    }
    ?>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email">

    <?php
    if (isset($errors['Errors validation']['email'])) {
      echo $errors['Errors validation']['email'];
    }
    ?>

  </div>

  <div class="mb-3">
    <label for="tel" class="form-label">Phone</label>
    <input type="text" class="form-control" id="tel" name="tel">

    <?php
    if (isset($errors['Errors validation']['tel'])) {
      echo $errors['Errors validation']['tel'];
    }
    ?>


  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">

    <?php
    if (isset($errors['Errors validation']['password'])) {
      echo $errors['Errors validation']['password'];
    }
    ?>


  </div>
  <div class="mb-3">
    <label for="password-confirm" class="form-label">Password confirm</label>
    <input type="password" class="form-control" id="password-confirm" name="password-confirm">

    <?php
    if (isset($errors['Errors validation']['password-confirm'])) {
      echo $errors['Errors validation']['password-confirm'];
    }
    ?>


  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>

