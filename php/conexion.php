<?php
  $link=null;
  function conectar(){
     $host="localhost";
     $usu="root";
     $pwd="";	 
     $db="dentista";
	 if(!($link=mysqli_connect($host,$usu,$pwd))){
	    echo "error al conectar con el host remoto";
		exit();
	 }
	 if(!mysqli_select_db($link,$db)){
	    echo "error al conectar con la base de datos".$db;
		exit();
	 }
	 
  }
  conectar();






  


