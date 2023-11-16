<?php
require_once __DIR__."/../dao/MidtermDao.php";

class MidtermService {
    protected $dao;

    public function __construct(){
        $this->dao = new MidtermDao();
    }

    /** TODO
    * Implement service method  to return detailed cap-table
    */
    public function cap_table(){
        $results = $this->dao->cap_table();
        //print_r($results);
        return $results;
        //Flight::json($results);

    }

    /** TODO
    * Implement service method to return cap-table summary
    */
    public function summary(){
        $results = $this->dao->summary();
        return $results;

    }

    /** TODO
    * Implement service method to return list of investors with their total shares amount
    */
    public function investors(){

        $results = $this->dao->investors();
        return $results;

    }
}
?>
