<?php

namespace OCA\UserList\Db;

use OCP\IDBConnection;
use OC;

class UserListDAO {

    private $db;

    public function __construct() {
    /** public function __construct(IDBConnection $db) { */
        /** $this->db = $db; */
        $this->db = OC::$server->getDatabaseConnection();
    }

    public function return_list() {
        $sql = 'SELECT * FROM `*PREFIX*accounts`';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $list = $stmt->fetchAll();

        $stmt->closeCursor();
        return $list;
    }
}
