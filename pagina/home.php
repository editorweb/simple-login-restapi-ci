<?php

session_start();

if ( isset( $_SESSION['id'] ) ) {
   echo "estas logeado " . $_SESSION['id'];
   echo "<br>";
   echo "<a href='logout.php'>Salir</a>";
} else {
    // Redirect them to the login page
    header("Location: login.php");
   
   //echo "no estas logeado " . $_SESSION['id'];
}