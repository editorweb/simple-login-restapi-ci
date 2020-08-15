<?php




function set_log($class,$method,$postdata,$auth){
	$CI = & get_instance();
	$url = $class.'/'.$method;
	$data = array('url'=>$url,
		'parameter'=>$postdata,
		'auth'=>$auth,
		'time'=>date('Y-m-d h:i:s'));
	$CI->db->insert('service_log',$data);
	return $CI->db->insert_id();
}


?>
