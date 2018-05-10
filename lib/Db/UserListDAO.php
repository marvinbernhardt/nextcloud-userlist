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

    public function return_userlist() {
        $sql =
            '
            SELECT `*PREFIX*accounts`.`uid` AS uid,
            GROUP_CONCAT(`*PREFIX*group_user`.`gid` SEPARATOR ", ") AS groups,
            `*PREFIX*accounts`.`data` AS account_data
            FROM `*PREFIX*accounts`
            LEFT JOIN `*PREFIX*group_user`
            ON `*PREFIX*accounts`.`uid`=`*PREFIX*group_user`.`uid`
            GROUP BY `*PREFIX*accounts`.`uid`
            ORDER BY `uid` ASC;
            ';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $list = $stmt->fetchAll();

        $stmt->closeCursor();
        return $list;
    }

    public function return_grouplist() {
        $sql =
            '
            SELECT *
            FROM `*PREFIX*groups`
            ORDER BY `gid` ASC;
            ';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $list = $stmt->fetchAll();

        $stmt->closeCursor();
        return $list;
    }
}
