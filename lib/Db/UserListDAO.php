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
SELECT
    accounts.uid,
    accounts.data AS account_data,
    circles,
    levels
FROM
    `*PREFIX*accounts` AS accounts
    LEFT JOIN (
        SELECT
            circles_members.user_id,
            GROUP_CONCAT(circles_circles.name SEPARATOR ", ") AS circles,
            GROUP_CONCAT(circles_members.level SEPARATOR ", ") as levels
        FROM
            `*PREFIX*circles_members` circles_members
        LEFT JOIN `*PREFIX*circles_circles` circles_circles ON circles_members.circle_id=LEFT(circles_circles.unique_id, 14)
        GROUP BY
            circles_members.user_id
    ) a ON a.user_id=accounts.uid
ORDER BY
    uid ASC;
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

    public function return_circles_circles() {
        $sql =
            '
SELECT *
FROM `*PREFIX*circles_circles`
ORDER BY `name` ASC;
            ';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $list = $stmt->fetchAll();

        $stmt->closeCursor();
        return $list;
    }
}
