<?php
if (isset($_SESSION['flash']['Errors'])) {
  $errors = $_SESSION['flash']['Errors'];
}
?>

<h1>Profil</h1>

<form action="" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Change name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?=$_SESSION['user']['name']?>">
    <?php
    if (isset($errors['name'])) {
      echo $errors['name'];
    }
    ?>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Change email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?=$_SESSION['user']['email']?>">
    <?php
    if (isset($errors['email'])) {
      echo $errors['email'];
    }
    ?>

  </div>

  <div class="mb-3">
    <label for="tel" class="form-label">Change phone</label>
    <input type="text" class="form-control" id="tel" name="tel" value="<?=$_SESSION['user']['tel']?>">
    <?php
    if (isset($errors['tel'])) {
      echo $errors['tel'];
    }
    ?>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Change password</label>
    <input type="password" class="form-control" id="password" name="password">
    <?php
    if (isset($errors['password'])) {
      echo $errors['password'];
    }
    ?>
  </div>
  <button type="submit" class="btn btn-primary">Change</button>
</form>

