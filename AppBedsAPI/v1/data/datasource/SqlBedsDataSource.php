<?php

/**
 * Data source in MySQL
 */
require_once 'tables.php';

class SQLBedsDataSource implements BedsDataSource {

    private $dbh;
    private $table_name = BED_TABLE_NAME;


    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }


    function retrieve() {
        $sql = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->dbh->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $stmt->errorInfo()[2];
        }
    }
}