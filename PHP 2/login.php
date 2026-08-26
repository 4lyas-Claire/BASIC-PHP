<?php include './layout/head.php'; ?>

<h1>Login</h1>

<form action="" method="POST">

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required>

    <br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required>

    <br><br>

    <button type="submit">Login</button>

</form>

<p>
    <a href="./forgot.php">Forgot Password?</a>
</p>

<p>
    Don't have an account?
    <a href="./register.php">Register here</a>
</p>

<?php include './layout/foot.php'; ?>