<?php
if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
}

?>

<h1>Login page</h1>

<?php
    if (isset($flash['Register Succes'])) {
        echo $flash['Register Succes'];
    }
    ?>

<form id="form" action="" method="post">
    <?php
    if (isset($flash['Login error'])) {
        echo $flash['Login error'];
    }
    ?>
    <div class="mb-3">
        <label for="name" class="form-label">Login</label>
        <input type="text" class="form-control" id="name" name="login">
        <?php
        if (isset($flash['Empty fields']['login'])) {
            echo $flash['Empty fields']['login'];
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <?php
        if (isset($flash['Empty fields']['password'])) {
            echo $flash['Empty fields']['password'];
        }
        ?>
    </div>
    <?php
    if (isset($flash['Captcha error'])) {
        echo $flash['Captcha error'];
    }
    ?>
    <div id="captcha-container" class="smart-captcha"
        data-sitekey="ysc1_IW6ysGiWpYnpcnrGCNs4qR4ZPV7D1F1gMfkr96Z327b70b18"></div>

    <input type="submit" class="btn btn-primary" onsubmit="handleSubmit()" />
</form>

<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>

</script>