<?php require './layout/head.php'; ?>

<h1>Forgot Password</h1>

<p>Enter your email address to reset your password.</p>

<form action="" method="POST">

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required>

    <br><br>

    <button type="submit">Reset Password</button>

</form>

<p>
    Remember your password?
    <a href="./login.php">Back to Login</a>
</p>

<?php require './layout/foot.php'; ?>