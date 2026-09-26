<?php require_once(APP_ROOT . '/views/includes/header.php'); ?>

<div class="container mt-3">
    <?php
        if(!(count($data) == 0)) { ?>

        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th width="120px">Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        foreach($data as $value) { ?>
                            <tr>
                                <td><?php echo $value->faculty_fname; ?></td>
                                <td><?php echo $value->faculty_mname; ?></td>
                                <td><?php echo $value->faculty_lname; ?></td>
                                <td><?php echo $value->faculty_age; ?></td>
                                <td><?php echo $value->faculty_gender; ?></td>
                                <td><?php echo $value->faculty_address; ?></td>
                                <td><?php echo $value->faculty_position; ?></td>
                                <td><?php echo $value->faculty_salary; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="edit(<?php echo $value->faculty_id; ?>)">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="del(<?php echo $value->faculty_id; ?>)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
            </tbody>
        </table>

        <?php
        }
    ?>

</div>

<?php require_once('./views/includes/modals/index.php');?>
<?php require_once('./views/includes/scripts/mandatory_script.php');?>
<?php require_once('./views/includes/scripts/main_script.php');?>
<?php require_once(APP_ROOT . '/views/includes/footer.php'); ?>