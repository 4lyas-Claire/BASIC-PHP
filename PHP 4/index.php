<?php
require_once 'dbcontroller.php';
$dbhandler = new DBController();

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $dbhandler->verifyData($_GET['id']);

    $deleteQuery = "DELETE FROM persons WHERE id = '$id'";
    $dbhandler->executeNonQueryIUP($deleteQuery);
    
    header("Location: index.php");
    exit();
}

if (isset($_POST['update_person'])) {
    $id      = $dbhandler->verifyData($_POST['id']);
    $fname   = $dbhandler->verifyData($_POST['person_fname']);
    $mname   = $dbhandler->verifyData($_POST['person_mname']);
    $lname   = $dbhandler->verifyData($_POST['person_lname']);
    $age     = $dbhandler->verifyData($_POST['person_age']);
    $gender  = $dbhandler->verifyData($_POST['person_gender']);
    $email   = $dbhandler->verifyData($_POST['person_email']);
    $address = $dbhandler->verifyData($_POST['person_address']);
    $contact = $dbhandler->verifyData($_POST['person_cnumber']);

    $updateQuery = "UPDATE persons SET 
                        person_fname = '$fname',
                        person_mname = '$mname',
                        person_lname = '$lname',
                        person_age = '$age',
                        person_gender = '$gender',
                        person_email = '$email',
                        person_address = '$address',
                        person_cnumber = '$contact'
                    WHERE id = '$id'";

    $dbhandler->executeNonQueryIUP($updateQuery);
    
    header("Location: index.php");
    exit();
}

if (isset($_GET["submit"])) {
    $where = array();

    if (!empty($_GET["person_fname"]))   $where[] = "person_fname LIKE '{$_GET["person_fname"]}%'";
    if (!empty($_GET["person_mname"]))   $where[] = "person_mname LIKE '{$_GET["person_mname"]}%'";
    if (!empty($_GET["person_lname"]))   $where[] = "person_lname LIKE '{$_GET["person_lname"]}%'";
    if (!empty($_GET["person_age"]))     $where[] = "person_age LIKE '{$_GET["person_age"]}%'";
    if (!empty($_GET["person_gender"]))  $where[] = "person_gender LIKE '{$_GET["person_gender"]}%'";
    if (!empty($_GET["person_email"]))   $where[] = "person_email LIKE '{$_GET["person_email"]}%'";
    if (!empty($_GET["person_address"])) $where[] = "person_address LIKE '{$_GET["person_address"]}%'";
    if (!empty($_GET["person_cnumber"])) $where[] = "person_cnumber LIKE '{$_GET["person_cnumber"]}%'";

    if (!empty($where)) {
        $query = "SELECT * FROM persons WHERE " . implode(" AND ", $where) . " ORDER BY person_lname";
    } else {
        $query = "SELECT * FROM persons ORDER BY person_lname";
    }
} else {
    $query = "SELECT * FROM persons ORDER BY person_lname";
}

$result = $dbhandler->executeQuery($query);

$editRecord = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $editId = $dbhandler->verifyData($_GET['id']);

    $editQuery = "SELECT * FROM persons WHERE id = '$editId'";
    $fetchResult = $dbhandler->executeQuery($editQuery);
    if (!empty($fetchResult)) {
        $editRecord = $fetchResult[0];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Registered Person</title>

    <link href="DataTables/datatables.min.css" rel="stylesheet"/>

    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial; }
        table { border-collapse: collapse; margin-block: 20px; width: 100%; }
        thead, tbody, th, td { border: 1px solid black; padding: 5px; }
        table input[type="text"], table input[type="submit"], table select { width: 100%; padding: 5px; }
        .edit-box { background: #f9f9f9; padding: 15px; border: 1px solid #ccc; margin-bottom: 20px; }
    </style>
</head>
<body>

    <?php if ($editRecord): ?>
    <div class="edit-box">
        <h3>Edit Person Record</h3>
        <form action="index.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($editRecord['id']) ? $editRecord['id'] : $editRecord['person_id']; ?>">
            <table>
                <tr><td>First Name</td><td><input type="text" name="person_fname" value="<?php echo $editRecord['person_fname']; ?>" required></td></tr>
                <tr><td>Middle Name</td><td><input type="text" name="person_mname" value="<?php echo $editRecord['person_mname']; ?>"></td></tr>
                <tr><td>Last Name</td><td><input type="text" name="person_lname" value="<?php echo $editRecord['person_lname']; ?>" required></td></tr>
                <tr><td>Age</td><td><input type="text" name="person_age" value="<?php echo $editRecord['person_age']; ?>" required></td></tr>
                <tr><td>Gender</td><td><input type="text" name="person_gender" value="<?php echo $editRecord['person_gender']; ?>" required></td></tr>
                <tr><td>Email</td><td><input type="text" name="person_email" value="<?php echo $editRecord['person_email']; ?>" required></td></tr>
                <tr><td>Address</td><td><input type="text" name="person_address" value="<?php echo $editRecord['person_address']; ?>" required></td></tr>
                <tr><td>Contact Number</td><td><input type="text" name="person_cnumber" value="<?php echo isset($editRecord['person_cnumber']) 
                ? $editRecord['person_cnumber'] : (isset($editRecord['person_contact']) ? $editRecord['person_contact'] : ''); ?>" required></td></tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update_person" value="Update Record">
                        <a href="index.php"><button type="button">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php endif; ?>

    <h2>List of Registered Person</h2>

    <p>
        This output connects to the database, retrieves data
        and allows the user to filter and search records.
    </p>

    <form action="index.php" method="GET">
    <table id="example">
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
                <th>Action</th>
            </tr>
            <tr>
                <th><input type="text" name="person_fname" value="<?php echo isset($_GET['person_fname']) ? $_GET['person_fname'] : ""; ?>"></th>
                <th><input type="text" name="person_mname" value="<?php echo isset($_GET['person_mname']) ? $_GET['person_mname'] : ""; ?>"></th>
                <th><input type="text" name="person_lname" value="<?php echo isset($_GET['person_lname']) ? $_GET['person_lname'] : ""; ?>"></th>
                <th><input type="text" name="person_age" value="<?php echo isset($_GET['person_age']) ? $_GET['person_age'] : ""; ?>"></th>
                <th>
                    <select name="person_gender">
                        <option value="" selected>Select All</option>
                        <option value="M" <?php echo (isset($_GET['person_gender']) && $_GET['person_gender'] == "M") ? "selected" : ""; ?>>Male</option>
                        <option value="F" <?php echo (isset($_GET['person_gender']) && $_GET['person_gender'] == "F") ? "selected" : ""; ?>>Female</option>
                    </select>
                </th>
                <th><input type="text" name="person_email" value="<?php echo isset($_GET['person_email']) ? $_GET['person_email'] : ""; ?>"></th>
                <th><input type="text" name="person_address" value="<?php echo isset($_GET['person_address']) ? $_GET['person_address'] : ""; ?>"></th>
                <th><input type="text" name="person_cnumber" value="<?php echo isset($_GET['person_cnumber']) ? $_GET['person_cnumber'] : ""; ?>"></th>
                <th><input type="submit" name="submit" value="Filter"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($result) {
                foreach ($result as $key => $value) {
                    // Extract Primary Key 'id'
                    $id = isset($value['id']) ? $value['id'] : (isset($value['person_id']) ? $value['person_id'] : '');
                    $contact = isset($value['person_cnumber']) ? $value['person_cnumber'] : (isset($value['person_contact']) ? $value['person_contact'] : '');

                    echo '
                        <tr>
                            <td>' . $value['person_fname'] . '</td>
                            <td>' . $value['person_mname'] . '</td>
                            <td>' . $value['person_lname'] . '</td>
                            <td>' . $value['person_age'] . '</td>
                            <td>' . $value['person_gender'] . '</td>
                            <td>' . $value['person_email'] . '</td>
                            <td>' . $value['person_address'] . '</td>
                            <td>' . $contact . '</td>
                            <td>
                                <a href="index.php?action=edit&id=' . $id . '"><button type="button">Edit</button></a>
                                <a href="index.php?action=delete&id=' . $id . '" onclick="return confirm(\'Are you sure you want to delete this record?\');"><button type="button">Delete</button></a>
                            </td>
                        </tr>
                    ';
                }
            }
            ?>
        </tbody>
    </table>
    </form>

    <script src="DataTables/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script>
        $(document).ready( () => {
            $('#example').DataTable({
                order: [],
                bFilter: false,
                bSortCellsTop: true,
                pageLength: 25
            });
        });
    </script>
</body>
</html>