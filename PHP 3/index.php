<?php include './layout/head.php'; ?>
    <h1>PHP Output 3</h1>
    <p>This output connects to the database and allows the user to save records into it.</p>

    <form action="redirect.php" method="POST">
        <h2>Register Person</h2>
        <table>
            <tr>
                <td>
                    <label for="fname">First Name</label>
                </td>
                <td>
                    <input type="text" name="fname" id="fname" placeholder="Enter First Name">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="mname">Middle Name</label>
                </td>
                <td>
                    <input type="text" name="mname" id="mname" placeholder="Enter Middle Name">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="lname">Last Name</label>
                </td>
                <td>
                    <input type="text" name="lname" id="lname" placeholder="Enter Last Name">
                </td>
            </tr>
            <tr>
                <td>Age</td>
                <td>
                    <input type="text" name="age" placeholder="Enter your Age" required />
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="text" name="gender" placeholder="Enter your Gender" required />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="email" placeholder="Enter your Email" required />
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" placeholder="Enter Address" required />
                </td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>
                    <input type="text" name="cnumber" placeholder="Enter Contact Number" required />
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="cancel" value="Cancel">
                </td>
            </tr>
        </table>
    </form>

<br><hr><br>

<h2>List of Registered Person</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact Number</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $servername = "127.0.0.1";
        $username   = "root";
        $password   = "";
        $db         = "myfirstdb";
        $port       = 3307;

        $conn = new mysqli($servername, $username, $password, $db, $port);

        if (!$conn->connect_error) {
            $sql = "SELECT * FROM persons";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['person_fname'] . "</td>";
                    echo "<td>" . $row['person_mname'] . "</td>";
                    echo "<td>" . $row['person_lname'] . "</td>";
                    echo "<td>" . $row['person_age'] . "</td>";
                    echo "<td>" . $row['person_gender'] . "</td>";
                    echo "<td>" . $row['person_email'] . "</td>";
                    echo "<td>" . $row['person_address'] . "</td>";
                    echo "<td>" . (isset($row['person_cnumber']) ? $row['person_cnumber'] : (isset($row['person_contact']) ? $row['person_contact'] : '')) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found.</td></tr>";
            }
            $conn->close();
        }
        ?>
    </tbody>
</table>

<?php include './layout/foot.php'; ?>