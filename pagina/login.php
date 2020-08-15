<?php
ob_start();
   session_start();
if ( isset( $_SESSION['id'] ) ) {
 header('Location: home.php');
}

if($_POST){
$username = $_POST["username"];

$password = $_POST["password"];

 

 $url = 'http://localhost/api/webservices/login';
 //echo $url;
 
    $data = '{"username":"' . $username . '","password":"' . $password . '"}';
   //echo $data;
    $data = domainCallAPI($url, $data);
    $datajson = json_decode($data, TRUE);
    //print_r($datajson);
    
   if($datajson['status']=="success"){
       $_SESSION['id'] =  $datajson['data']['user_id'];
       //  $var =  $datajson['status']['user_id'];
       //echo $var;
      // echo $_SESSION['id'];
       header('Location: home.php');
       
   }else{
       
       echo "error intente de nuevo";
	   
	   print_r($datajson);
   }
 
 
 
}else{



?>


<html>
    
    
    
    <head><meta charset="gb18030">
        
    </head>

<body>
    
    
  <form action="login.php" method="post">
 

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
  
  </div>

  
</form>
</body>

</html>





<?php

}


function domainCallAPI( $url, $data = false) {
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_POST, 1);
 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 return curl_exec($curl);
 curl_close ($ch);
}






?>