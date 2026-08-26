<?php require './layout/head.php'; ?>

<h1>Register</h1>

<form action="" method="POST">

    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name" required>

    <br><br>

    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name" required>

    <br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required>

    <br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required>

    <br><br>

    <button type="submit">Register</button>

</form>

<p>
    Already have an account?
    <a href="./login.php">Login here</a>
</p>

<?php require './layout/foot.php'; ?>