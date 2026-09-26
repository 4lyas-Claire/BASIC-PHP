<?php 

require_once('./models/MainModel.php');

class MainController {
    private $model;

    public function __construct() {
        $this->model = new MainModel();
    }

    public function index() {
        $active = 'index';
        require_once('./views/main/index.php');
    }

    public function display() {
        $active = 'display';
        $data = $this->model->getAllRecords();
        require_once('./views/main/display.php');
    }

    public function register($data = []) {
        $record = [];
        foreach($data['data'] as $value) {
            $record[$value['name']] = trim(htmlspecialchars($value['value']));
        }
    
        if($this->model->register($record)){
            echo 'Successfully Saved!';
        }
    }

    public function getFacultyData($id) { // Changed from getStudentData
        if($this->model->getFacultyData($id)) {
            $data = $this->model->getFacultyData($id);
            echo json_encode($data);
        }
    }

    public function edit($data = []) {
        $record = [];
        foreach ($data['data'] as $value) {
            $record[$value['name']] = trim(htmlspecialchars($value['value']));
        }

        if($this->model->edit($record)) {
            echo 'Successfully Edited!';
        }
    }

    public function delete($id) {
        if($this->model->delete($id)) {
            echo 'Successfully Deleted!';
        }
    }
}