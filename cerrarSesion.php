<?php
   session_start();//recuperamos la sesion
   session_unset(); //liberamos espacios de variables
   session_destroy();//destruimos la sesión
   header("location:index.php");
?>