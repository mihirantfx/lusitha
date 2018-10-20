<?php

/*
 * Author: Mihiran Rupasinghe
 * Email: mihiran.rupasinghe@titanfx.com
 * Company: Technium eCommerce
 * Date: 2017-07-24
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User_MODEL extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_details_db($data) {

        /*
         * Must do binf param to avoid sql injection
         */

        /*
         * This technique is called prepared statements.
         * recommended way to query in CI
         */
        $sql = "SELECT user_id, user_name, user_address,user_tp FROM user WHERE user_id=?";
        $stmt = $this->db->conn_id->prepare($sql);

        //bind parameters
        $stmt->bindParam(1, $data["id"]);
        $stmt->execute();

        //fetch values
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }

    public function set_user_details_db($data) {

        $res = array();

        $sql = "INSERT INTO user (user_name,user_address,user_tp) VALUES (?,?,?)";
        $stmt = $this->db->conn_id->prepare($sql);

        //bind parameters
        $stmt->bindParam(1, $data["user_name_post"]);
        $stmt->bindParam(2, $data["user_add_post"]);
        $stmt->bindParam(3, $data["user_tp_post"]);

        if ($stmt->execute()) {
            $inserted_id = $this->db->conn_id->lastInsertId();
            $res = $this->get_user_details_db(array("id" => $inserted_id));
        }

        return $res;
    }

}
