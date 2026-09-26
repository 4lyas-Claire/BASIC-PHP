<?php

require_once(APP_ROOT . '/libraries/Database.php');

class MainModel {

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllRecords() {
        $this->db->setQuery("SELECT * FROM faculty");
        return $this->db->getResultSet();
    }

    public function register($data = []) {
        $arrayKeys = array_keys($data);
 
        $arrayOfParams = array_map(
            function($val) {
                return ':' . $val;
            }, 
            $arrayKeys
        );

        $paramString = implode(', ', $arrayOfParams);
        
        // Changed table and columns to match faculty fields
        $this->db->setQuery("INSERT INTO faculty(faculty_fname, faculty_mname, faculty_lname, faculty_age, faculty_gender, faculty_address, faculty_position, faculty_salary)
                                VALUES($paramString)");
        
        for($i=0; $i<count($arrayOfParams); $i++) {
            $this->db->bindValue($arrayOfParams[$i], $data[$arrayKeys[$i]]);
        }

        return $this->db->execute();
    }

    public function getFacultyData($id) {
        $this->db->setQuery("SELECT * FROM faculty WHERE faculty_id=:id");
        $this->db->bindValue(':id', $id);
        return $this->db->getSingleRecord();
    }

    public function edit($data = []) {
        $fieldNames = array_keys($data);

        $dbFieldNames = array_map(function($field) {
            return 'faculty_' . $field;
        }, $fieldNames);

        $fieldParams = array_map(function($field) {
            return ':' . $field;
        }, $fieldNames);

        $paramArray = [];
        $facID = '';
        foreach ($fieldNames as $key => $value) {
            if(!($value == 'id')) {
                $str = $dbFieldNames[$key] . '=' . $fieldParams[$key];
                array_push($paramArray, $str);
            } else {
                $facID = $dbFieldNames[$key] . '=' . $fieldParams[$key];
            }
        }

        $paramString = implode(', ', $paramArray);

        // Updated update query table name
        $this->db->setQuery("UPDATE faculty SET $paramString WHERE $facID");
        
        for($i=0; $i<count($fieldNames); $i++) {
            $this->db->bindValue($fieldParams[$i], $data[$fieldNames[$i]]);
        }

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->setQuery("DELETE FROM faculty WHERE faculty_id=:id");
        $this->db->bindValue(':id', $id);
        return $this->db->execute();
    }
}