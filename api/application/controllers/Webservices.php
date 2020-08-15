 <?php

 defined('BASEPATH')OR exit('No direct script access allowed');
 header('Content-Type: text/html; charset=utf-8');

 // Allow from any origin
 if (isset($_SERVER['HTTP_ORIGIN'])) {
       header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
       header('Access-Control-Allow-Credentials: true');
       header('Access-Control-Max-Age: 86400'); // cache for 1 day
 }

 // Access-Control headers are received during OPTIONS requests
 if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
             header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
             header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

       exit(0);
 }

 class Webservices extends CI_Controller { 
       public function __construct() {
             parent::__construct();
             $this->load->model('Webservice_model');
            
             if ($this->input->server('REQUEST_METHOD') == 'GET')
                   $postdata = json_encode($_GET);
             else if ($this->input->server('REQUEST_METHOD') == 'POST')
                   $postdata = file_get_contents("php://input");
  $class = $this->router->fetch_class();
             $method = $this->router->fetch_method();
             $auth = '';

             if (isset(apache_request_headers()['Auth'])) {
                   $auth = apache_request_headers()['Auth'];
             }

             $this->last_id = set_log($class, $method, $postdata, $auth);

       }

    function response($res) {
           //  $this->db->where('id', $this->last_id)->update('service_log', array('result' => $res));
             print json_encode($res);
       }

        
       
        public function login() {

       $postdata = file_get_contents("php://input");
             $request = json_decode($postdata, true);
              
             $result = $this->Webservice_model->login($request);
             header('Content-type: application/json');
             if ($result) {
                   $result = array('status' => 'success', 'data' => $result);
             } else {
                   $result = array('status' => 'error', 'message' => 'Unknown Credential! Try Again', 'error' => '502');
             }

             $this->response($result);          
     
	 
       }

     }
 ?>