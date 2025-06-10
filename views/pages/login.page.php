<?php
if (isset($_SESSION['flash'])) {
    $errors = $_SESSION['flash'];
}

?>

<h1>Login page</h1>

<form id="form" action="" method="post">
    <?php
    if (isset($errors['Login error'])) {
        echo $errors['Login error'];
    }
    ?>
    <div class="mb-3">
        <label for="name" class="form-label">Login</label>
        <input type="text" class="form-control" id="name" name="login">
        <?php
        if (isset($errors['Empty fields']['login'])) {
            echo $errors['Empty fields']['login'];
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <?php
        if (isset($errors['Empty fields']['password'])) {
            echo $errors['Empty fields']['password'];
        }
        ?>
    </div>
    <?php
    if (isset($errors['Captcha error'])) {
        echo $errors['Captcha error'];
    }
    ?>
    <div id="captcha-container" class="smart-captcha"
        data-sitekey="ysc1_IW6ysGiWpYnpcnrGCNs4qR4ZPV7D1F1gMfkr96Z327b70b18"></div>

    <input type="submit" class="btn btn-primary" onsubmit="handleSubmit()" />
</form>

<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

</script>