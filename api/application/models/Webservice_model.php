<?php

class Webservice_model extends CI_Model {

      function __construct() {

            parent::__construct();

      }


 function login($request) {
  
       $this->db->where("(email = '".$request['username']/*."' OR name ='".$request['username']*/."' OR phone = '".$request['username']."')");

            $this->db->where('password', md5($request['password']));

            $this->db->where('status !=', 2);
            $query = $this->db->get('customer');

            if ($query->num_rows() > 0) {

                  
                  $rs = $query->row();

                   

                  return $result = array('status' => 'success', 'user_id' => $rs->id);

            } else {

                  return false;

            }
  

      }


}
?>