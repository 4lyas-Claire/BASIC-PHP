<?php

$servername = "127.0.0.1";
$username   = "root";
$password   = "";
$db         = "myfirstdb";
$port       = 3307;

$conn = new mysqli($servername, $username, $password, $db, $port);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {

    $fname   = $_POST['fname'];
    $mname   = $_POST['mname'];
    $lname   = $_POST['lname'];
    $age     = $_POST['age'];
    $gender  = $_POST['gender'];
    $email   = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['cnumber'];

    $sql = "INSERT INTO persons
            (person_fname, person_mname, person_lname, person_age,
             person_gender, person_email, person_address, person_cnumber)
            VALUES
            ('$fname', '$mname', '$lname', '$age',
             '$gender', '$email', '$address', '$contact')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    header("Location: index.php");
    exit();
}

$conn->close();
?>