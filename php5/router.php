<?php

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'register' :
            $main->register($_POST);
            break;
        case 'display' :
            $main->display();
            break;
        case 'getFacultyData' : // Changed from getStudentData
            $main->getFacultyData($_POST['id']);
            break;
        case 'edit' :
            $main->edit($_POST);
            break;
        case 'delete' :
            $main->delete($_POST['id']);
            break;
    }
} else {
    $main->index();
}