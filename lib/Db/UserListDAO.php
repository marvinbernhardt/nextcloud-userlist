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
    GROUP_CONCAT(DISTINCT group_user.gid SEPARATOR ", ") AS groups,
    GROUP_CONCAT(DISTINCT circles_names.name SEPARATOR ", ") AS circles
FROM
    `*PREFIX*accounts` AS accounts
    LEFT JOIN `*PREFIX*group_user` group_user ON accounts.uid=group_user.uid
    LEFT JOIN (
        SELECT
            circles_members.user_id,
            circles_circles.name
        FROM
            `*PREFIX*circles_members` circles_members
        LEFT JOIN `*PREFIX*circles_circles` circles_circles ON circles_members.circle_id=LEFT(circles_circles.unique_id, 14)
    ) circles_names ON accounts.uid=circles_names.user_id
GROUP BY
    accounts.uid
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
