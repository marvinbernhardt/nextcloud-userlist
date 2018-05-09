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
		$sql =
'
SELECT `e2Pn2_accounts`.`uid` AS usr,
GROUP_CONCAT(`e2Pn2_group_user`.`gid` SEPARATOR "<br>") AS groups,
`e2Pn2_accounts`.`data` AS dat
FROM `e2Pn2_accounts`
JOIN `e2Pn2_group_user`
WHERE `e2Pn2_accounts`.`uid`=`e2Pn2_group_user`.`uid`
GROUP BY `e2Pn2_accounts`.`uid`
';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $list = $stmt->fetchAll();

        $stmt->closeCursor();
        return $list;
    }
}
