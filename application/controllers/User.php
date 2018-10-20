<?php

/*
 * Author: Mihiran Rupasinghe
 * Email: mihiran.rupasinghe@titanfx.com
 * Company: Technium eCommerce
 * Date: 2018-03-03
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    //constructor
    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('User_MODEL');
    }

    public function index() {
        die('No direct script access allowed');
    }

    public function get_user_details() {
        //get input
        $get_data = $this->input->get();

        //set return data first
        $return = array("status" => 1);

        //check user id is coming from front end
        if (isset($get_data["user_id"])) {
            //using helper function, check id is a number
            if (check_number($get_data["user_id"])) {
                //if number, get data from db
                $result = $this->User_MODEL->get_user_details_db(array("id" => $get_data["user_id"]));
                if (empty($result)) {
                    //if empty, user id not found
                    $return["status"] = 0;
                    $return["data"] = "User id not found!";
                } else {
                    $return["data"] = $result;
                }
            } else {
                //if user_id not set, then error
                $return["status"] = 0;
                if ($get_data["user_id"] == '') {
                    $return["data"] = "User id is empty!";
                } else {
                    $return["data"] = "User id not a number!";
                }
            }
        } else {
            //if user_id not set, then error
            $return["status"] = 0;
            $return["data"] = "User id is not set!";
        }

        //return values
        echo json_encode($return);
    }

    public function set_user_details(){
        $post_data = $this->input->post();
        $res = $this->User_MODEL->set_user_details_db($post_data);
        if(!empty($res)){
            echo json_encode(array("status"=>1, "data"=>$res));
        }else{
            echo json_encode(array("status"=>0, "data"=>"Something went wrong. Please try again later!"));
        }
    }
}
